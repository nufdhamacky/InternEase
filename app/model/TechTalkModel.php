<?php

class TechTalkModel extends Model{

    public function get_techtalks() {
        $query = "
            SELECT
                c.company_name,
                t.topic,
                t.from_date,
                t.to_date
            FROM `tech_talk` AS t
            JOIN company AS c ON t.company_id = c.user_id
            WHERE t.status = 1 OR t.status=0
        ";
    
        $results = $this->query($query);
        $techtalks = [];
        if(empty($results)){
            return 0;
        }
    
        foreach ($results as $r) {
            $techtalks[] = [
                
                'title' => $r['topic'],
                'start' => date('Y-m-d\TH:i', strtotime($r['from_date'])),
                'end' => date('Y-m-d\TH:i', strtotime($r['to_date'])),

            ];
        }
    
        return json_encode($techtalks);
    }

    public function store_techtalk($data){
        $this->setTable('tech_talk');
        $this->insert($data);  
        return 1;
    }

    
    

   

}
