<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excelreport extends CI_Controller {
	
	public function registered_users(){
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('REGISTERED USERS');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->setCellValue('B2', 'REGISTERED USERS REPORT');
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(20);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->mergeCells('B2:F2');
		$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('B4', 'No');
		$this->excel->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('C4', 'ID');
		$this->excel->getActiveSheet()->getStyle('C4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('D4', 'Name');
		$this->excel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('E4', 'Email');
		$this->excel->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('F4', 'Date');
		$this->excel->getActiveSheet()->getStyle('F4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$styleArray = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THICK
			)
		  )
		);
		$this->excel->getActiveSheet()->getStyle("B4:F4")->applyFromArray($styleArray);
		$styleArray = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		  )
		);
		
		$this->load->model('model_users');
		$i = 0;
		$start_date = $this->input->post("startdate");
		$end_date = $this->input->post("enddate");
		foreach($this->model_users->get_registered_users($start_date,$end_date) as $result){
				$i += 1;
				$pos = $i + 4;
				$this->excel->getActiveSheet()->setCellValue("B$pos", $i);
				$this->excel->getActiveSheet()->getStyle("B$pos")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue("C$pos", $result->id);	
				$this->excel->getActiveSheet()->getStyle("C$pos")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue("D$pos", $result->full_name);
				$this->excel->getActiveSheet()->setCellValue("E$pos", $result->email);
				$this->excel->getActiveSheet()->setCellValue("F$pos", $result->date);			
				$this->excel->getActiveSheet()->getStyle("F$pos")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle("B$pos:F$pos")->applyFromArray($styleArray);
				
        }
		unset($styleArray);
		$filename='registered_users_report.xls';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		$objWriter->save('php://output');
	}
	
	public function active_users(){
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('ACTIVE USERS');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->setCellValue('B2', 'ACTIVE USERS REPORT');
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(20);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->mergeCells('B2:F2');
		$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('B4', 'No');
		$this->excel->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('C4', 'ID');
		$this->excel->getActiveSheet()->getStyle('C4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('D4', 'Name');
		$this->excel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('E4', 'Email');
		$this->excel->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('F4', 'Activity Count');
		$this->excel->getActiveSheet()->getStyle('F4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$styleArray = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THICK
			)
		  )
		);
		$this->excel->getActiveSheet()->getStyle("B4:F4")->applyFromArray($styleArray);
		$styleArray = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		  )
		);
		
		$this->load->model('model_users');
		$i = 0;
		foreach($this->model_users->get_active_users() as $result){
				$i += 1;
				$pos = $i + 4;
				$this->excel->getActiveSheet()->setCellValue("B$pos", $i);
				$this->excel->getActiveSheet()->getStyle("B$pos")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue("C$pos", $result->id);	
				$this->excel->getActiveSheet()->getStyle("C$pos")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue("D$pos", $result->full_name);
				$this->excel->getActiveSheet()->setCellValue("E$pos", $result->email);
				$this->excel->getActiveSheet()->setCellValue("F$pos", $result->log_count);			
				$this->excel->getActiveSheet()->getStyle("F$pos")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle("B$pos:F$pos")->applyFromArray($styleArray);
				
        }
		unset($styleArray);
		$filename='active_users_report.xls';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		$objWriter->save('php://output');
	}
}
