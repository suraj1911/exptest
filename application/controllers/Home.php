<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;

 
class Home extends CI_Controller {
	
	public function __construct()
	{
            parent::__construct();
            $this->load->model("Excel_export","site");
            
	}

	public function index()
    {
           
           $data['users'] = $this->site->fetch_data();
           $this->load->view("home_view",$data);

           //To check out Second type of view Please Comment Out Below Line
          // $this->load->view("home_view1",$data);
     }
    
    public function fetchData() 
    {

        $columns = array(
            0 => 'user_id',
            1 => 'username',
            2 => 'first_name',
            3 => 'last_name',
            4 => 'gender',
            5 => 'password'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->site->get_all_data_count();
       
        $totalFiltered = $totalData;
        
        if (empty($this->input->post('search')['value'])) {

            $vendors = $this->site->get_data($limit, $start, $order, $dir);

        } else {
           
            $search = $this->input->post('search')['value'];

            $vendors = $this->site->get_data_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->site->get_data_search_count($limit, $start, $search, $order, $dir);
        }


        $data = array();

        if (!empty($vendors)) {
            
            foreach ($vendors as $vdr) {
                $nestedData['user_id'] = $vdr->user_id;
                $nestedData['username'] = $vdr->username;
                $nestedData['first_name'] = $vdr->first_name;
                $nestedData['last_name'] = $vdr->last_name;
                $nestedData['gender'] = $vdr->gender;
                $nestedData['password'] = $vdr->password;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }

    public function export(){
     
            $extension = $this->input->post('export_type');
            if(!empty($extension)){
              $extension = $extension;
            } else {$empInfo = $this->site->fetch_data();
              $extension = 'xlsx';
            }
            $this->load->helper('download');  
            $data = array();
            $data['title'] = 'Export Excel Sheet | Coders Mag';
            // get employee list
            
            //echo count($empInfo);die;
            $fileName = 'employee-'.time(); 
            $spreadsheet = new spreadsheet();

            $sheet = $spreadsheet->getActiveSheet();

                $sheet->setCellValue('A1', 'ID');
                $sheet->setCellValue('B1', 'User Name');
                $sheet->setCellValue('C1', 'First Name');
                $sheet->setCellValue('D1', 'Last Name');
                $sheet->setCellValue('E1', 'Gender');
                $sheet->setCellValue('F1', 'Password');

                $rowCount = 2;

                foreach ($empInfo as $element) {

                    $sheet->setCellValue('A' . $rowCount, $element['user_id']);
                    $sheet->setCellValue('B' . $rowCount, $element['username']);
                    $sheet->setCellValue('C' . $rowCount, $element['first_name']);
                    $sheet->setCellValue('D' . $rowCount, $element['last_name']);
                    $sheet->setCellValue('E' . $rowCount, $element['gender']);
                    $sheet->setCellValue('F' . $rowCount, $element['password']);
                    $rowCount++;
                }

            if($extension == 'xlsx') {
              $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
              $fileName = $fileName.'.xlsx';
            } else {
              $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
              $fileName = $fileName.'.xls';
            }

            $this->output->set_header('Content-Type: application/vnd.ms-excel');
            $this->output->set_header('Cache-Control: max-age=0');
            $writer->save(ROOT_UPLOAD_PATH.$fileName); 
            $filepath = file_get_contents(ROOT_UPLOAD_PATH.$fileName);
            force_download($fileName, $filepath);
            
        }
    }
?>