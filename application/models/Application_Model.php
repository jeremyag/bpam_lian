<?php
    class Application{
        public $id;
        public $code;
        public $isNew;
        public $date_of_application;
        public $amendment_from;
        public $amendment_to;
        public $municipality;
        public $business_id;

        public function set_instance_array($arr){
            $this->id = $arr['id'];
            $this->code = $arr['code'];
            $this->isNew = $arr['isNew'];
            $this->date_of_application = $arr['date_of_application'];
            $this->amendment_from = $arr['amendment_from'];
            $this->amendment_to = $arr['amendment_to'];
            $this->municipality = $arr['municipality'];
            $this->business_id = $arr['business_id'];
        }

        public function get_type(){
            return ($this->isNew ? 'New' : 'Renewal');
        }

        public function get_date_of_application($format = 'Y-m-d'){
            $date = new DateTime($this->date_of_application);

            return $date->format($format);
        }

        public function get_business(){
            $CI =& get_instance();
            return $CI->Business_Model->get_business_from_id($this->business_id);
        }

        public function get_business_activities(){
            $CI =& get_instance();

            return $CI->Business_Activity_Model->get_business_activities_from_application_id($this->id);
        }

        public function get_status(){
            $CI =& get_instance();

            return $CI->Application_Model->get_status_from_id($this->id);
        }

        public function get_verifications(){
            $CI =& get_instance();

            return $CI->Verification_Document_Details_Model->get_verifications_from_application_id($this->id);
        }

        public function get_assessments(){
            $CI =& get_instance();

            return $CI->Assessment_Fees_Model->get_assessments_from_application_id($this->id);
        }

        public function is_done(){
            $CI =& get_instance();

            $status = $this->get_status();

            if(($status->verifyAgain == 0) && $status->isVerified && $status->isAssessed){
                return true;
            }
            return false;
        }

        public function get_current_status(){
            $status = $this->get_status();

            if($status->isVerified == 0){
                return "unverified";
            }
            elseif($status->verifyAgain == 1){
                return "missing-docs";
            }
            elseif($status->isVerified == 1 && $status->verifyAgain == 0 && $status->isAssessed == 0){
                return "on-assessment";
            }
            elseif($status->isAssessed == 1){
                if($this->get_license()){
                    return "done";
                }
                return "needs-license";
            }
        }

        public function get_bootstrap_color(){
            $status = $this->get_current_status();
            $color = "";
            if($status == "unverified"){
                $color = "danger";
            }
            elseif($status == "missing-docs"){
                $color = "warning";
            }
            elseif($status == "on-assessment"){
                $color = "success";
            }
            elseif($status == "done"){
                $color = "primary";
            }

            return $color;
        }

        public function get_license(){
            $CI =& get_instance();

            return $CI->License_Model->get_licenses_from_application_id($this->id);
        }
    }

    class Application_Model extends CI_Model{
        public function insert($application){
            $sql = "INSERT INTO `application` (`id`, `code`, `isNew`, `date_of_application`, `amendment_from`, `amendment_to`, `municipality`, `business_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $this->db->query($sql, $application);

            return $this->db->insert_id();
        }

        public function count($filter = "", $join = ""){
            $sql = "SELECT
                        COUNT(*) as total
                    FROM
                        `application` a 
                    $join
                    WHERE
                        1=1 $filter";
            
            $result = $this->db->query($sql);

            $result = $result->row(0);

            return $result->total;
        }
        public function get_all_application($filter = "", $order_by = "a.`id` DESC", $limit = "0, 1000",$join = "", $type="all"){
            if($type=="all"){
                $sql = "SELECT
                            a.*
                        FROM
                            `application` a 
                        $join
                        WHERE
                            1=1 $filter
                        ORDER BY
                            $order_by
                        -- LIMIT
                            -- $limit";
            }
            elseif("assessment"){
                 $sql = "SELECT *
                        FROM `application` a
                        WHERE 
                            (SELECT COUNT(*) FROM verification_document_details WHERE application_id = a.id) > 0 AND
                            (SELECT COUNT(*) FROM verification_document_details WHERE application_id = a.id AND remarks = 'No') = 0
                        ORDER BY $order_by ";
            }
            $applications = array();

            $result = $this->db->query($sql);

            foreach($result->result('Application') as $a){
                $applications[] = $a;
            }

            return $applications;
        }

        public function get_application_from_id($id){
            $sql = "SELECT * FROM `application` WHERE id = ?";

            $query = $this->db->query($sql, $id);

            return $query->row(0, 'Application');
        }

        public function get_status_from_id($id){
            $sql = "SELECT 
                        IF(
                            (SELECT COUNT(*) FROM verification_document_details WHERE application_id = $id) > 0,
                            1,
                            0
                        ) AS isVerified,
                        IF(
                            (SELECT COUNT(*) FROM verification_document_details WHERE application_id = $id AND remarks = 'No') > 0,
                            1,
                            0
                        ) AS verifyAgain,
                        IF(
                            (SELECT COUNT(*) FROM assessment_fees WHERE application_id = $id) > 0,
                            1,
                            0
                        ) AS isAssessed,
                        IF(
                            (SELECT 
                                COUNT(*)
                            FROM
                                license
                            WHERE application_id = $id) > 0, 1, 0
                        ) AS isLicensed";

            
            $result = $this->db->query($sql);

            return $result->row(0);
        }

        public function update_basic_information($application_id, $mode_of_payment, $date_application, $dti_reg_no, $tin, $dti_reg_date, $type, $amendment_from, $amendment_to, $tax_incentives, $last_name, $first_name, $middle_name, $business_name, $trade_name){
            $application = $this->Application_Model->get_application_from_id($application_id);

            $business = $application->get_business();

            $business_id = $business->id;

            $sql = "UPDATE 
                        `business` 
                    SET 
                        `mode_of_payment` = '$mode_of_payment',
                        `dti_reg_no` = '$dti_reg_no',
                        `dti_reg_date` = '$dti_reg_date',
                        `type` = '$type',
                        `tax_incentives` = '$tax_incentives',
                        `business_name` = '$business_name',
                        `trade_name` = '$trade_name'
                    WHERE 
                        `id` = $business_id";

            $this->db->query($sql);

            $sql = "UPDATE 
                        `application`
                    SET
                        `date_of_application` = '$date_application',
                        `amendment_from` = '$amendment_from',
                        `amendment_to` = '$amendment_to'
                    WHERE
                        `id` = $application_id";
            
            $this->db->query($sql);

            $owner = $business->get_owner();

            $owner_id = $owner->id;

            $sql = "UPDATE 
                        `owner`
                    SET 
                        `tin` = '$tin',
                        `last_name` = '$last_name',
                        `first_name` = '$first_name',
                        `middle_name` = '$middle_name'
                    WHERE
                        `id` = $owner_id";

            $this->db->query($sql);
        }

        public function update_other_information($business_id, $street, $brgy, $postal_code, $email, $mobile, $telephone, $owner_street, $owner_brgy, $owner_city, $owner_province, $owner_postal_code, $owner_email, $owner_mobile, $owner_telephone, $ecd_full_name, $ecd_telephone, $ecd_email, $business_area, $total_no_employees, $no_lgu_residing){
            $business = $this->Business_Model->get_business_from_id($business_id);

            $business_address = $business->get_business_address();

            $sql = "UPDATE
                        `business_address`
                    SET
                        `street` = '$street',
                        `brgy` = '$brgy',
                        `postal_code` = '$postal_code',
                        `email` = '$email',
                        `mobile` = '$mobile',
                        `telephone` = '$telephone'
                    WHERE id = ".$business_address->id;

            $this->db->query($sql);

            $owner = $business->get_owner();

            $sql = "UPDATE
                        `owner`
                    SET
                        `street` = '$owner_street',
                        `brgy` = '$owner_brgy',
                        `city` = '$owner_city',
                        `province` = '$owner_province',
                        `postal_code` = '$owner_postal_code',
                        `email` = '$owner_email',
                        `mobile` = '$owner_mobile',
                        `telephone` = '$owner_telephone'
                    WHERE 
                        `id` = ".$owner->id;
            
            $this->db->query($sql);

            $ecd = $business->get_emergency_contact_details();

            $sql = "UPDATE
                        `emergency_contact_details`
                    SET
                        `full_name` = '$ecd_full_name',
                        `telephone` = '$ecd_telephone',
                        `email` = '$ecd_email'
                    WHERE 
                        `id` = ".$ecd->id;

            $this->db->query($sql);
            
            $bd = $business->get_business_details();

            $sql = "UPDATE
                        `business_details`
                    SET
                        `business_area` = $business_area,
                        `total_no_employees` = $total_no_employees,
                        `no_lgu_residing` = $no_lgu_residing
                    WHERE
                        `id` = ".$bd->id;

            $this->db->query($sql);
        }

        public function submit_business_activity($business_activity_id, $line_of_business, $no_of_units, $capitalization, $essential_receipts, $non_essential_receipts){
            $sql = "UPDATE 
                        `business_activity`
                    SET
                        `line_of_business` = '$line_of_business',
                        `no_of_units` = $no_of_units,
                        `capitalization` = $capitalization,
                        `essential_receipts` = $essential_receipts,
                        `non_essential_receipts` = $non_essential_receipts
                    WHERE
                        `id` = $business_activity_id";

            $this->db->query($sql);
        }

        public function delete($id){
            $application = $this->Application_Model->get_application_from_id($id);

            $ba = $application->get_business_activities();

            if(count($ba)){
                foreach($ba as $a){
                    $sql = "DELETE FROM `business_activity` WHERE id = ".$a->id;

                    $this->db->query($sql);
                }
            }
            $sql = "DELETE FROM `application` WHERE id = $id";

            $this->db->query($sql);
        }
    }
?>