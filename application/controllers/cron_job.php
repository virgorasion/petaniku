<?php class Reminders extends CI_Controller{ 
    public function __construct() 
    { 
        parent::__construct();
    }
    public function index()
    {
        if(!$this->input->is_cli_request())
        {
            echo "This script can only be accessed via the command line" . PHP_EOL;
            return;
        }
        $timestamp = strtotime("+1 days");
        $appointments = $this->Appointment_model->get_days_appointments($timestamp);
        if(!empty($appointments))
        {
            foreach($appointments as $appointment)
            {
                $this->email->set_newline("\r\n");
                $this->email->to($appointment->email);
                $this->email->from("youremail@example.com");
                $this->email->subject("Appointment Reminder");
                $this->email->message("You have an appointment tomorrow");
                $this->email->send();
                $this->Appointment_model->mark_reminded($appointment->id);
            }
        }
    }
}
