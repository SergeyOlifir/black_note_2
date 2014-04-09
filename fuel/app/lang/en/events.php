<?php 
    return array(
        'invite' => array(
            'mail' => array(
                'subject' => 'Event :name you are invited via :uri',
                'body' => "Dear Friends! \n You invited to the event :name. \n Description: \n :description \n Location: :location \n Start: :startdate \n \n Whith the app :applink you cat take pictures and upload pictures during the event. Just download and install to your device. \n Your code to join the Event :name is: :code \n The function take and upload pictures :activate \n Best regards \n :hostname",
                'activate' => 'is already activated',
                'not_activate' => 'will be activated at :date'
             )
        )
    );
?>
