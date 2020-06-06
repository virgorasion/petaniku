<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locationid_model extends CI_Model
{
    //add country
    public function add_country()
    {
        $data = array(
            'name' => $this->input->post('name', true)
        );

        return $this->db->insert('countries', $data);
    }

    //update country
    public function update_country($id)
    {
        $data = array(
            'name' => $this->input->post('name', true)
        );

        $this->db->where('id', $id);
        return $this->db->update('countries', $data);
    }

    //add state
    public function add_state()
    {
        $data = array(
            'name' => $this->input->post('name', true)
        );

        return $this->db->insert('provinces', $data);
    }

    //update state
    public function update_state($id)
    {
        $data = array(
            'name' => $this->input->post('name', true),
        );

        $this->db->where('id', $id);
        return $this->db->update('provinces', $data);
    }


    //get countries
    public function get_countries()
    {
        $this->db->order_by('countries.id');
        $query = $this->db->get('countries');
        return $query->result();
    }

    //get paginated countries
    public function get_paginated_countries($per_page, $offset)
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $this->db->like('countries.name', $q);
        }
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('countries');
        return $query->result();
    }

    //get paginated countries count
    public function get_paginated_countries_count()
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $this->db->like('countries.name', $q);
        }
        $query = $this->db->get('countries');
        return $query->num_rows();
    }

    //get country
    public function get_country($id)
    {
        $id = clean_number($id);
        $this->db->where('countries.id', $id);
        $this->db->limit(8);
        $query = $this->db->get('countries');
        return $query->row();
    }

    //delete country
    public function delete_country($id)
    {
        $id = clean_number($id);
        $country = $this->get_country($id);
        if (!empty($country)) {
            $this->db->where('id', $id);
            return $this->db->delete('countries');
        }
        return false;
    }

    //get states
    public function get_states()
    {
        $this->db->order_by('provinces.name');
        $query = $this->db->get('provinces');
        return $query->result();
    }

    //get paginated states
    public function get_paginated_states($per_page, $offset)
    {
        $country = $this->input->get('country', true);
        $q = trim($this->input->get('q', true));
        $this->db->select('provinces.*');
        if (!empty($q)) {
            $this->db->group_start();
            $this->db->like('provinces.name', $q);
            $this->db->group_end();
        }
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('provinces');
        return $query->result();
    }

    //get paginated states count
    public function get_paginated_states_count()
    {
        $country = $this->input->get('country', true);
        $q = trim($this->input->get('q', true));
        $this->db->select('provinces.*');
        if (!empty($q)) {
            $this->db->group_start();
            $this->db->or_like('provinces.name', $q);
            $this->db->group_end();
        }
        $query = $this->db->get('provinces');
        return $query->num_rows();
    }

    //get state
    public function get_state($id)
    {
        $id = clean_number($id);
        $this->db->where('provinces.id', $id);
        $query = $this->db->get('provinces');
        return $query->row();
    }

    //get states by country
    public function get_states_by_country($country_id)
    {
        $country_id = clean_number($country_id);
        $this->db->order_by('provinces.name');
        $query = $this->db->get('provinces');
        return $query->result();
    }

    //set location settings
    public function set_location_settings()
    {
        $default_product_location = $this->input->post('default_product_location', true);
        $country_id = $this->input->post('country_id', true);

        $data = array(
            'default_product_location' => 0
        );

        if ($default_product_location == 1) {
            if (!empty($country_id)) {
                $data = array(
                    'default_product_location' => $country_id
                );
            }
        }

        $this->db->where('id', 1);
        return $this->db->update('general_settings', $data);
    }

    //delete state
    public function delete_state($id)
    {
        $id = clean_number($id);
        $state = $this->get_state($id);
        if (!empty($state)) {
            $this->db->where('id', $id);
            return $this->db->delete('provinces');
        }
        return false;
    }

    //add city
    public function add_city()
    {
        $data = array(
            'name' => $this->input->post('name', true),
            'province_id' => $this->input->post('province_id', true)
        );

        return $this->db->insert('regencies', $data);
    }

    //update city
    public function update_city($id)
    {
        $data = array(
            'name' => $this->input->post('name', true),
            'province_id' => $this->input->post('province_id', true)
        );

        $this->db->where('id', $id);
        return $this->db->update('regencies', $data);
    }

    //get cities
    public function get_cities()
    {
        $this->db->order_by('regencies.name');
        $query = $this->db->get('regencies');
        return $query->result();
    }

    //get kecamatans
    public function get_kecamatans()
    {
        $this->db->order_by('districts.name');
        $query = $this->db->get('districts');
        return $query->result();
    }

    //get kecamatan
    public function get_kecamatan($id)
    {
        $id = clean_number($id);
        $this->db->where('districts.id', $id);
        $query = $this->db->get('districts');
        return $query->row();
    }

    //get kecamatan by city
    public function get_kecamatan_by_city($city)
    {
        $this->db->where('regency_id', $city);
        $this->db->order_by('districts.name');
        $query = $this->db->get('districts');
        return $query->result();
    }


    //get kecamatan in array
    public function get_kecamatan_in_array($id)
    {
			// die(json_encode($id));        
        $this->db->where_in('districts.id', $id);
        $this->db->order_by('districts.name');
        $query = $this->db->get('districts');
        return $query->result();
    }

    //get paginated cities
    public function get_paginated_cities($per_page, $offset)
    {
        $country = $this->input->get('country', true);
        $state = $this->input->get('state', true);
        $q = trim($this->input->get('q', true));
        $this->db->join('provinces', 'cities.province_id = provinces.id');
        $this->db->select('regencies.*, provinces.name as state_name');
        if (!empty($state)) {
            $this->db->where('regencies.state_id', $state);
        }
        if (!empty($q)) {
            $this->db->group_start();
            $this->db->like('regencies.name', $q);
            $this->db->group_end();
        }
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('regencies');
        return $query->result();
    }

    //get paginated cities count
    public function get_paginated_cities_count()
    {
        $country = $this->input->get('country', true);
        $state = $this->input->get('state', true);
        $q = trim($this->input->get('q', true));
        $this->db->join('provinces', 'cities.province_id = provinces.id');
        $this->db->select('regencies.*');
        if (!empty($state)) {
            $this->db->where('regencies.state_id', $state);
        }
        if (!empty($q)) {
            $this->db->group_start();
            $this->db->like('regencies.name', $q);
            $this->db->group_end();
        }
        $query = $this->db->get('regencies');
        return $query->num_rows();
    }

    //get city
    public function get_city($id)
    {
        $id = clean_number($id);
        $this->db->where('regencies.id', $id);
        $query = $this->db->get('regencies');
        return $query->row();
    }

    //get cities by country
    public function get_cities_by_country($country_id)
    {
        $country_id = clean_number($country_id);
        $this->db->order_by('regencies.name');
        $query = $this->db->get('regencies');
        return $query->result();
    }

    //get cities by state
    public function get_cities_by_state($state_id)
    {
        $state_id = clean_number($state_id);
        $this->db->where('regencies.province_id', $state_id);
        $this->db->order_by('regencies.name');
        $query = $this->db->get('regencies');
        return $query->result();
    }

    //get cities in array
    public function get_cities_in_array($id)
    {
			// die(json_encode($id));        
        $this->db->where_in('regencies.id', $id);
        $this->db->order_by('regencies.name');
        $query = $this->db->get('regencies');
        return $query->result();
    }

    //delete city
    public function delete_city($id)
    {
        $id = clean_number($id);
        $city = $this->get_city($id);
        if (!empty($city)) {
            $this->db->where('id', $id);
            return $this->db->delete('regencies');
        }
        return false;
    }

    //search countries
    public function search_countries($val)
    {
        $val = remove_special_characters($val);
        $this->db->like('countries.name', $val);
        $query = $this->db->get('countries');
        return $query->result();
    }

    //search states
    public function search_states($val)
    {
        $val = remove_special_characters($val);
        $this->db->join('countries', 'countries.id = "102"');
        $this->db->select('provinces.*, countries.name as country_name, countries.id as country_id');
        $this->db->like('provinces.name', $val);
        // $this->db->or_like('CONCAT(provinces.name, " ", countries.name)', $val);
        $this->db->limit(100);
        $query = $this->db->get('provinces');
        return $query->result();
    }

    //search cities
    public function search_cities($val)
    {
        $val = remove_special_characters($val);
        $this->db->join('countries', 'countries.id = "102"');
        $this->db->join('provinces', 'regencies.province_id = provinces.id');
        $this->db->select('regencies.*, countries.id as country_id, countries.name as country_name, provinces.id as state_id, provinces.name as state_name');
        $this->db->like('regencies.name', $val);
        $this->db->where('countries.id', '102');
        // $this->db->or_like('CONCAT(regencies.name, " ",states.name, " ", countries.name)', $val);
        $this->db->limit(200);
        $query = $this->db->get('regencies');
        return $query->result();
    }

    //get location input
    public function get_location_input($country_id, $state_id, $city_id)
    {
        $country_id = clean_number($country_id);
        $state_id = clean_number($state_id);
        $city_id = clean_number($city_id);
        $str = "";
        if (!empty($country_id)) {
            $country = $this->get_country($country_id);
            if (!empty($country)) {
                $str = $country->name;
            }
        }
        if (!empty($state_id)) {
            $state = $this->get_state($state_id);
            if (!empty($state)) {
                $str = $state->name . ', ' . $str;
            }
        }
        if (!empty($city_id)) {
            $city = $this->get_city($city_id);
            if (!empty($city)) {
                $str = $city->name . ', ' . $str;
            }
        }
        return $str;
    }

}