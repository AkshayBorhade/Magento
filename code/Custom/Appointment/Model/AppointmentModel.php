<?php

namespace Custom\Appointment\Model;

use Custom\Appointment\Api\Appointment;

class AppointmentModel implements Appointment {

    public function __construct(\Custom\Appointment\Model\AppointmentFactory $appointmentFactory
    ) {
        $this->appointmentFactory = $appointmentFactory;
    }

    public function getAll() {
        $appointmentFactory = $this->appointmentFactory->create()->getCollection();

        $i = 0;

        foreach ($appointmentFactory as $appointment) {
            $data[$i]['name'] = $appointment->getName();
            $data[$i]['email'] = $appointment->getEmail();
            $i++;
        }

        echo json_encode($data);
        die;
    }

    /**
     * @api
     * @param string $id
     * @return json
     */
    public function getById($id) {


        $appointmentFactory = $this->appointmentFactory->create()->getCollection();

        $appointmentFactory->addFieldToFilter('app_id', $id);

        $appointment=$appointmentFactory->getFirstItem();

        if(count($appointmentFactory)>0){
        $data['name'] = $appointment->getName();
        $data['email'] = $appointment->getEmail();
        echo json_encode($data);
        }else{
        echo "Invalid Id";
        }
        
        
        die;
    }

}
