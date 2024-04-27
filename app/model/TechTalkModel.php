<?php

class TechTalkModel extends Model{

    public function get_techtalks() {
        $query = "
            SELECT
                c.company_name,
                t.topic,
                t.from_date,
                t.to_date,
                t.location
            FROM `tech_talk` AS t
            JOIN company AS c ON t.company_id = c.user_id
            WHERE t.status = 1
        ";
    
        $results = $this->query($query);
        $techtalks = [];
    
        foreach ($results as $r) {
            $techtalks[] = [
                
                'title' => $r['topic'], // FullCalendar expects 'title'
                'start' => date(DATE_ISO8601, strtotime($r['from_date'])), // Convert to ISO 8601 format
                'end' => date(DATE_ISO8601, strtotime($r['to_date'])), // Convert to ISO 8601 format
                'location' => $r['location'] ,

            ];
        }
    
        // Encode the array as JSON and return it
        return json_encode($techtalks);
    }

    public function store_techtalk($data){
        $this->setTable('tech_talk');
        $this->insert($data);  
        return 1;
    }
    
    

   

}
