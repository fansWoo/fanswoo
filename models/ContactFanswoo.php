<?php

class ContactFanswoo extends Contact
{
	
    public function attr_setting()
    {
        parent::attr_setting();

        $this->attr('company')->field('company');
        $this->attr('address')->field('address');
        $this->attr('classtype2')->field('classtype2');
        $this->attr('budget_range')->field('budget_range');
    }

}