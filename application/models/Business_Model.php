<?php
    class Business{
        public $id;
        public $bp_no;
        public $mode_of_payment;
        public $dti_reg_no;
        public $dti_reg_date;
        public $type;
        public $category;
        public $tax_incentives;
        public $trade_name;
        public $business_name;
        public $emergency_contact_details_id;
        public $owner_id;
        public $business_details_id;
        public $business_address_id;
        public $isClosed;

        public function set_instance_array($arr){
            $this->id = $arr['id'];
            $this->bp_no = $arr['bp_no'];
            $this->mode_of_payment = $arr['mode_of_payment'];
            $this->dti_reg_no = $arr['dti_reg_no'];
            $this->dti_reg_date = $arr['dti_reg_date'];
            $this->type = $arr['type'];
            $this->category = $arr['category'];
            $this->tax_incentives = $arr['tax_incentives'];
            $this->trade_name = $arr['trade_name'];
            $this->business_name = $arr['business_name'];
            $this->emergency_contact_details_id = $arr['emergency_contact_details_id'];
            $this->owner_id = $arr['owner_id'];
            $this->business_details_id = $arr['business_details_id'];
        }

        public function get_owner(){
            $CI =& get_instance();
            return $CI->Owner_Model->get_owner_from_id($this->owner_id);
        }

        public function get_dti_reg_date($format = "Y-m-d"){
            $date = new DateTime($this->dti_reg_date);

            return $date->format($format);
        }

        public function get_business_address(){
            $CI =& get_instance();

            return $CI->Business_Address_Model->get_business_address_from_id($this->business_address_id);
        }

        public function get_emergency_contact_details(){
            $CI =& get_instance();

            return $CI->Emergency_Contact_Details_Model->get_emergency_contact_details_from_id($this->emergency_contact_details_id);
        }

        public function get_business_details(){
            $CI =& get_instance();

            return $CI->Business_Details_Model->get_business_details_from_id($this->business_details_id);
        }

        public function get_lessor_details(){
            $CI =& get_instance();

            $has_lessor = $CI->Business_Model->has_lessor($this->id);

            if($has_lessor->hasLessor){
                return $CI->Lessor_Details_Model->get_lessor_details_from_business_id($this->id);
            }
            else{
                return false;
            }
        }

        public function get_current_license(){
            $CI =& get_instance();

            return $CI->License_Model->get_licenses_from_business_id($this->id, "current");
        }
    }

    class Business_Model extends CI_Model{
        public function insert($business){
            $sql = "INSERT INTO business (`id`, `bp_no`, `mode_of_payment`, `dti_reg_no`, `dti_reg_date`, `type`, `category`, `tax_incentives`, `trade_name`, `business_name`, `emergency_contact_details_id`, `owner_id`, `business_details_id`, `business_address_id`, `isClosed`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $this->db->query($sql, $business);

            return $this->db->insert_id();
        }

        public function update($id, $b){
            $update_column = build_update_columns($b);
            
            $sql = "UPDATE `business` SET $update_column WHERE `id` = $id";

            $this->db->query($sql);
        }

        public function get_all_businesses($filter = "", $order_by = "b.`id` DESC", $limit = "0, 1000",$join = "", $type="all"){
            $sql = "SELECT
                        b.*
                    FROM
                        `business` b
                        $join
                    WHERE 
                        1 = 1
                        $filter
                    ORDER BY
                        $order_by";
            
            $query = $this->db->query($sql);

            return $query->result("Business");
        }

        public function get_business_from_id($id){
            $sql = "SELECT * FROM `business` WHERE id = ?";

            $query = $this->db->query($sql, $id);

            return $query->row(0, 'Business');
        }

        public function has_lessor($id){
            $sql = "SELECT IF((SELECT business_id FROM lessor_details WHERE business_id = ?) IS NULL, 0, 1) AS hasLessor";

            $query = $this->db->query($sql, $id);

            return $query->row(0);
        }

        public function search($keyword = ""){
            $filter = ""; 

            $join = "INNER JOIN 
                        emergency_contact_details ecd
                            ON
                                b.emergency_contact_details_id = ecd.id
                    INNER JOIN
                        `owner` o
                            ON
                                b.owner_id = o.id
                    INNER JOIN
                        business_details bd
                            ON
                                b.business_details_id = bd.id
                    INNER JOIN
                        business_address ba
                            ON
                                b.business_address_id = ba.id
                    LEFT JOIN
                        lessor_details ld
                            ON
                                ld.business_id = b.id
                    LEFT JOIN
                        lessor l
                            ON
                                l.id = ld.lessor_id
                    LEFT JOIN
                        license li
                            ON
                                li.business_id = b.id";

            $keywords = explode(" ", $keyword);

            foreach($keywords as $keyword){
                $filter .= " AND (".build_search_filter($this->Table_Model->get_columns("business"), $keyword, "b").
                " OR ".build_search_filter($this->Table_Model->get_columns("emergency_contact_details"), $keyword, "ecd").
                " OR ".build_search_filter($this->Table_Model->get_columns("owner"), $keyword, "o").
                " OR ".build_search_filter($this->Table_Model->get_columns("business_details"), $keyword, "bd").
                " OR ".build_search_filter($this->Table_Model->get_columns("business_address"), $keyword, "ba").
                " OR ".build_search_filter($this->Table_Model->get_columns("lessor_details"), $keyword, "ld").
                " OR ".build_search_filter($this->Table_Model->get_columns("lessor"), $keyword, "l").
                " OR ".build_search_filter($this->Table_Model->get_columns("license"), $keyword, "li")." )";
            }

            return $this->get_all_businesses($filter = $filter, $order_by = "b.`id` DESC", $limit = "0, 1000",$join = $join, $type="all");
        }

        public function filter($business_no = "", $business_name = "", $category = "", $owner = "", $barangay = ""){
            $filter = "";

            $join = "INNER JOIN 
                        owner o
                            ON 
                                o.id = b.owner_id
                    INNER JOIN
                        business_address ba
                            ON
                                ba.id = b.business_address_id";
            
            $filter = " AND (
                                b.id = $business_no AND 
                                b.business_name LIKE '%$business_name%' AND 
                                b.category LIKE '%$category%' AND 
                                CONCAT(o.first_name, ' ', o.middle_name, ' ', o.last_name) LIKE '%$owner%' AND
                                ba.brgy LIKE '%$barangay%'
                            )";
            
            return $this->get_all_businesses($filter = $filter, $order_by = "b.`id` DESC", $limit = "0, 1000",$join = $join, $type="all");
        }
    }
?>