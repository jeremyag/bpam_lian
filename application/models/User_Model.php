<?php 
    class User{
        public $id;
        public $first_name;
        public $middle_name;
        public $last_name;
        public $username;
        public $password;
        public $email;
        public $contact_no;
        public $gender;
        public $position;
        public $isActive;

        public function get_fullname(){
            return $this->first_name . " " . $this->middle_name . " " . $this->last_name;
        }

        public function get_arr_no_id(){
            $arr = (array) $this;
            unset($arr["id"]);
            return $arr;
        }
    }

    class User_Model extends CI_Model{
        public function register($param){
            //Set an SQL Insert Query.
            $sql = "INSERT INTO user VALUES ('', ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";

            //Query the SQL to the database.
            $this->db->query($sql, $param);

            //Get the last inserted value;
            $new_user = $this->db->insert_id();

            $new_user = $this->get_user_from_id($new_user);

            return $new_user;
            
        }

        public function get_user_from_id($id){
            //Set an SQL SELECT query.
            $sql = "SELECT * FROM user WHERE id = ?";
            
            //Query the SQL to the Database.
            $result = $this->db->query($sql, array($id));

            $result = $result->result('User');

            //Return the user
            return $result[0];
        }

        public function get_all_users(){
            $sql = "SELECT * FROM user";

            $result = $this->db->query($sql);

            $users = array();

            $result = $result->result('User');

            foreach($result as $row){
                array_push($users,$row);
            }

            return $users;
        }

        public function is_username_exist($username){
            $sql = "SELECT * FROM user WHERE username = ?";

            $result = $this->db->query($sql, array($username));
            
            if(count($result->result()) > 0){
                return TRUE;
            }
            return FALSE;


        }

        public function get_user_from_username($username){
            $sql = "SELECT id FROM user WHERE username = '$username'";

            $result = $this->db->query($sql);

            $result = $this->get_user_from_id($result->result()[0]->id);

            return $result;
        }

        public function get_account_statistics(){
            $sql = "SELECT 
                        (SELECT COUNT(*) FROM `user` WHERE `user`.`position` = 'Administrator') AS administrator,
                        (SELECT COUNT(*) FROM `user` WHERE `user`.`position` = 'Checker') AS checkers,
                        (SELECT COUNT(*) FROM `user` WHERE `user`.`position` = 'Treasurer') AS treasurer;";

            $result = $this->db->query($sql);

            return $result->result()[0];
        }

        public function disable_account($id){
            $sql = "UPDATE user SET isActive = 0 WHERE id = $id";
            echo $sql;
            $this->db->query($sql);
        }

        public function enable_account($id){
            $sql = "UPDATE user SET isActive = 1 WHERE id = $id";
            echo $sql;
            $this->db->query($sql);
        }

        public function update($input){
            if($input['form_password'] != ''){
                $param = array(
                    'first_name'=>$input['form_first_name'],
                    'middle_name'=>$input['form_middle_name'],
                    'last_name'=>$input['form_last_name'],
                    'password'=>md5($input['form_password']),
                    'position'=>$input['form_position'],
                    'contact_no'=>$input['form_contact_no'],
                    'email'=>$input['form_email'],
                    'id'=>$input['id']
                );

                $sql = "UPDATE user 
                        SET first_name = ?, 
                            middle_name = ?,
                            last_name = ?,
                            `password` = ?,
                            position = ?,
                            contact_no = ?,
                            email = ?
                        WHERE id = ?";

                $this->db->query($sql, $param);
            }
            else{
                $param = array(
                    'first_name'=>$input['form_first_name'],
                    'middle_name'=>$input['form_middle_name'],
                    'last_name'=>$input['form_last_name'],
                    'position'=>$input['form_position'],
                    'contact_no'=>$input['form_contact_no'],
                    'email'=>$input['form_email'],
                    'id'=>$input['id']
                );
                $sql = "UPDATE user 
                        SET first_name = ?, 
                            middle_name = ?,
                            last_name = ?,
                            position = ?,
                            contact_no = ?,
                            email = ?
                        WHERE id = ?";

                $this->db->query($sql, $param);
            }           
        }
    }

?>