<?php

namespace Custom\Inquiry\Model;

use Custom\Inquiry\Api\Inquiry;

class InquiryModel implements Inquiry {

    public function __construct(\Custom\Inquiry\Model\InquiryFactory $inquiryFactory
    ) {
        $this->inquiryFactory = $inquiryFactory;
    }

    public function getAll() {
        $inquiryFactory = $this->inquiryFactory->create()->getCollection();

        $i = 0;

        foreach ($inquiryFactory as $inquiry) {
            $data[$i]['name'] = $inquiry->getName();
            $data[$i]['email'] = $inquiry->getEmail();
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


        $inquiryFactory = $this->inquiryFactory->create()->getCollection();

        $inquiryFactory->addFieldToFilter('inqu_id', $id);

        $inquiry=$inquiryFactory->getFirstItem();

        if(count($inquiryFactory)>0){
        $data['name'] = $inquiry->getName();
        $data['email'] = $inquiry->getEmail();
        echo json_encode($data);
        }else{
        echo "Invalid Id";
        }
        
        
        die;
    }

}
