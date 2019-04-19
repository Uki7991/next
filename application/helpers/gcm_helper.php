<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GCM
 *
 * @author Ravi Tamada
 */

class GCM {

    //put your code here
    // constructor
    function __construct() {
        
    }

    /**
     * Sending Push Notification
     */
    public function send($type, $fields){
        $url = 'https://fcm.googleapis.com/fcm/send';
        
       $api_key = "AAAA5U5N3P0:APA91bHLKa9x051ToI_AUy4b-4capuppHdwEaX6eTzxv1WkK9tyFLonlQF6MEuyBOLqZAUzd4SteXaprsjt1Y5PYAS6hSUn604FyWRc7IcBtObO09KXjeoDNZqozIL5-EDDLQECh93bl";
        
        
        $headers = array(
            'Authorization: key=' .$api_key ,
            'Content-Type: application/json'
        );
        
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        
        // Close connection
        curl_close($ch);
        
        return $result;
        

    }
    public function send_notification($registatoin_ids, $message, $type) {
        
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
            'notification' => $message,
        ); 
        if($type == "android")
        {
            $fields = array(
                        'to' => $registatoin_ids,
                        'notification' => $message,
                        'priority' => 'high',
                        'content_available' => true
                    );

        }
      return  $this->send($type, $fields);
    }
    public function send_topics($topics, $message, $type) {
        
        $fields = array(
            'to' => $topics,
            'data' => $message,
        );
        if($type=="android")
        {
            $fields = array(
                'to' => $topics,
                'notification' => $message,
                'priority' => 'high',
                'content_available' => true
            );
            
} 
        return $this->send($type, $fields);
    }

}

?>