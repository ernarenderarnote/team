<?php

namespace App\Helper;

use Config;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class Common
{

	public $request;

	public function  __construct(Request $request)
	{
		$this->request = $request;
	}
    
    public function createToken()
    {

    	$key = Config::get('app.key');

        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }

		return hash_hmac('sha256', Str::random(40), $key);
    }

    function validatecard($number)
	{

	    $cardtype = array(
	        "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
	        "mastercard" => "/^5[1-5][0-9]{14}$/",
	        "amex"       => "/^3[47][0-9]{13}$/",
	        "discover"   => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
	    );

	    if (preg_match($cardtype['visa'],$number))
	    {
			$type= "visa";
	        return 'visa';
	    }
	    else if (preg_match($cardtype['mastercard'],$number))
	    {
			$type= "mastercard";
	        return 'mastercard';
	    }
	    else if (preg_match($cardtype['amex'],$number))
	    {
			$type= "amex";
	        return 'amex';
		
	    }
	    else if (preg_match($cardtype['discover'],$number))
	    {
			$type= "discover";
	        return 'discover';
	    }
	    return "visa";
	 }


  
    public function fileUpload($fileName, $path = '')
    {
    	//$original_path = $request->file($file)->getRealPath();
	    $file = $this->request->file($fileName); 
	    $fileExtension = $file->getClientOriginalExtension();
	    $originalFilename = $file->getClientOriginalName();

	    $cfile = time().'-'.str_random(6).'-'. $originalFilename;
	   	
	    $file->move(base_path() . '/public/uploads/' . $path, $cfile);
	    
	    return  $cfile;
    }

    public function categories()
    {

    	return [
    	
    			"Business Services" => [    	
										'Accountant ',
										'Accounting Clerk ',
										'Accounts Payable Clerk ',
										'Accounts Payable Lead ',
										'Business Manager/Director',
										'Buyer',
										'Chief Financial Officer ',
										'Payroll Clerk ',
										'Payroll Supervisor',
										'Purchasing Clerk ',
										'Purchasing Supervisor',
		        ],

		        "Clerical" => [
							'Receptionist',
							'Secretary to Director',
							'Secretary to Executive/Chief',
							'Secretary to Superintendent',
				],

				"Communications" => [
								'Communication Specialist',
								'Communications Officer',
				],

				"Curriculum" => [
						'Director of Research, Evaluation, and Accountability',
						'Instructional Coordinator ',
						'Testing Coordinator',
				],

				"Executive Office" => [
						'Attorney ',
						'Internal Audito',
				],

				"Human Resources" => [
					"Certification Specialist  ",
					"Chief Human Resource Officer  ",
					"Compensation Analyst ",
					"Employee Benefits Specialist ",
					"Human Resource Records Clerk  ",
					"Human Resource Secretary  ",
					"Human Resource Specialist  ",
					"Leave Specialist  ",
					"Position Control Specialist  ",
					"Staffing Administrator  ",
					"Substitute Specialist ",
				],

				"Instructional Technology" => [
					"Computer Lab Aide  ",
					"Director of Instructional Technology   ",
					"Instructional Technology Specialist  ",
				],
				"Risk Management" => [
					"Risk Manager  ",
					"Safety Coordinator ",
					"Workers\' Compensation Specialist  ",
				],
				"Tax Office" => [
					"Tax Assessor Collector",
					"Tax Clerk  ",
				],
				"Technology" => [
					"Chief Technology Officer  ",
					"Computer Technician  ",
					"Data Entry Clerk  ",
					"District PEIMS Data Coordinator ",
					"Help Desk Technician  ",
					"Network Administrator ",
					"Network Technician  ",
					"Programmer/Analyst  ",
					"Telecommunications Technician  ",
					"Technology Secretary  ",
					"Web Administrator ",
				],
				"Athletics" => [
					"Assistant Director-Athletics  ",
					"Athletic Trainer  ",
					"Campus Athletic Coordinator",
					"Coach  ",
					"Director of Athletics-Non-coaching  ",
					"Director of Athletics/Head Football Coach",
				],
				"Counseling" => [
					"Academic Advisor  ",
					"Director of School Counseling  ",
					"Drug Abuse Prevention Specialist  ",
					"School Counselor  ",
					"Social Worker  ",
					"Truancy Officer  ",
				],
				"Health Services" => [
					"Health Services Coordinator  ",
					"Health Services/Clinic Aide ",
					"Licensed Vocational Nurse (LVN)  ",
					"School Nurse-RN ",
				],
				"Library Services" => [
					"Director of Library and Media Services",
					"Librarian  ",
					"Library Specialist  ",
				],
				"Special Education" => [
					"Behavior Intervention Specialist   ",
					"Deaf Education Interpreter  ",
					"Diagnostician  ",
					"Director of Special Education  ",
					"Licensed Specialist in School Psychology  ",
					"Occupational Therapist  ",
					"Occupational Therapy Assistant  ",
					"Physical Therapist  ",
					"Physical Therapy Assistant  ",
					"Speech-Language Pathologist  ",
					"Speech-Language Pathology Assistant  ",
				],
				"Special Programs" => [
					"Adult and Community Education Coordinator  ",
					"At-Risk Coordinator",
					"Bilingual Coordinator  ",
					"Career and Technical Education Director  ",
					"Federal/Special Programs Coordinator  ",
					"Fine Arts Director ",
					"Gifted and Talented Coordinator  ",
					"Grant Writer  ",
					"Migrant Recruiter   ",
				],
				"Campus Administration" => [
					"Assistant Principal  ",
					"Principal  ",
				],
				"Campus Aides" => [
					"Classroom Instructional Aide ",
					"Computer Lab Aide  ",
					"Health Services/Clinic Aide  ",
					"In-School Suspension Aide  ",
					"Library Aide  ",
					"Special Education Aide-Self Contained  ",
					"Special Needs Aide ",
				],
				"Campus Clerical" => [
					"Attendance/PEIMS Clerk  ",
					"Bookkeeper-High School  ",
					"Campus Receptionist  ",
					"Counselor Secretary  ",
					"Registrar  ",
					"Secretary to Principal  ",
				],
				"Campus Professionals" => [
					"Academic Advisor  ",
					"Agricultural Science Teacher  ",
					"Athletic Trainer  ",
					"Band Director  ",
					"Behavior Intervention Specialist  ",
					"Career and Technical Education Teacher  ",
					"Career and Technical Education Teacher—Internship Program ",
					"Career and Technical Education Teacher—Laboratory Program  ",
					"Coach  ",
					"School Counselor  ",
					"School Nurse  ",
					"Special Education Teacher  ",
					"Teacher ",
				],
				"Library Sciences" => [
					"Librarian  ",
					"Library Specialist  ",
				],
				"Child Nutrition" => [
					"Cafeteria Manager  ",
					"Child Nutrition Program Director ",
					"Cafeteria Worker ",
				],
				"Maintenance" => [
					"Carpenter  ",
					"Construction Project Specialist  ",
					"Custodial Services Supervisor  ",
					"Custodian  ",
					"Director of Maintenance  ",
					"Electrician  ",
					"Energy Efficiency Technician  ",
					"Energy Manager  ",
					"General Maintenance Worker  ",
					"Grounds Foreman  ",
					"Groundskeeper ",
					"Heating, Ventilation, and Air Conditioning (HVAC) Technician ",
					"Lead Custodian ",
					"Maintenance Foreman ",
					"Maintenance Secretary ",
					"Painter ",
					"Pest Control Specialist ",
					"Plumber ",
				],
				"Security" => [
					"Chief of Police  ",
					"Crossing Guard  ",
					"Dispatcher-Security  ",
					"Police Officer  ",
					"Security Guard  ",
					"Security Technician  ",
				],
				"Transportation" => [
					"Bus Driver  ",
					"Bus Maintenance Worker  ",
					"Bus Monitor ",
					"Director of Transportation  ",
					"Dispatcher-Transportation  ",
					"Lead Bus Driver  ",
					"Lead Mechanic  ",
					"Mechanic Assistant  ",
					"Parts Technician  ",
					"Route Coordinator  ",
					"Shop Foreman  ",
					"Special Education Bus Driver  ",
					"Transportation Secretary  ",
					"Vehicle Mechanic ",
				],
				"Warehouse" => [
					"Delivery Driver  ",
					"Instructional Materials & Fixed Asset Specialist  ",
					"Warehouse Foreman  ",
					"Warehouse Worker ",
				],


    	];

    }

    public function grade()
    {
    	return [
    		"Elementary Certificate Standards" => [
    			'Art Generalist EC-6',
				'Physical Education Generalist EC-6',
				'English Language Arts and Reading Generalist EC-6  ',
				'Music Generalist EC-6',
				'Health Generalist EC-6',
				'Science Generalist EC-6',
				'Mathematics Generalist',
				'Social Studies Generalist EC-6',
				'Bilingual Generalist Grades EC-6',
				'ESL Generalist Grades EC- 6',
    		],

    		"Middle School Certificate Standards" => [
    			'English Language Arts and Reading 4-8',
				'Science 4-8',
				'Mathematics 4-8  ',
				'Social Studies 4-8',
				'Bilingual Generalist Grades 4-8',
				'English Language Arts and Reading Grades 4-8',
				'English Language Arts and Reading/Social Studies Grades 4-8',
				'ESL Generalist Grades 4-8',
				'Mathematics (Grades 4-8)',
				'Mathematics/Science (Grades 4-8',
				'Science (Grades 4-8)',
				'Social Studies (Grades 4-8)',
    		],

    		"Secondary Certificate Standards" => [
				'Agricultural Sciences and Technology Grades 6-12',
				'Agriculture, Food, and Natural Resources Grades 6-12',
				'Business and Finance Grades 6-12',
				'Business Education Grades 6-12',
				'Chemistry Grades 7-12',
				'Computer Science Grades 8-12',
				'Dance Grades 8-12',
				'English Language Arts and Reading Grades 8-12',
				'English Language Arts and Reading Grades 7-12',
				'Family and Consumer Sciences Grades 6-12',
				'Health Science Grades 6-12',
				'Health Science Technology Education Grades 8-12',
				'History Grades 7-12',
				'Family and Consumer Sciences Composite Grades 6-12',
				'Human Development and Family Studies Grades 8-12',
				'Journalism Grades 8-12',
				'Journalism Grades 7-12',
				'Life Science Grades 7-12',
				'Marketing Education Grades 8-12 ',
				'Marketing Grades 6-12',
				'Mathematics Grades 7-12',
				'Mathematics/Physical Science/Engineering Grades 8-12',
				'Mathematics/Physical Science/Engineering Grades 6-12',
				'Mathematics/Physics Grades 8-12 ',
				'Mathematics/Physics Grades 7-12',
				'Pedagogy and Professional Responsibilities for Trade and Industrial Education Grades 8-12',
				'Physical Science Grades 6-12',
				'Science Grades 7-12',
				'Social Studies Grades 7-12',
				'Speech Grades 7-12',
				'Technology Applications Grades 8-12',
				'Technology Education Grades 6-12',
				'Trade and Industrial Education: Professional Responsibilities Grades 6-12',
    		],

    		"All-level Certificate Standards" => [
				'American Sign Language - written Grades EC-12',
				'Art EC-Grade 12',
				'Deaf and Hard of Hearing EC-Grade 12',
				'Health EC-Grade 12',
				'Languages other than English EC-Grade 12',
				'Music Grades EC-12',
				'Physical Education Grades EC-12',
				'Special Education EC-Grade 12',
				'Technology Applications EC-Grade 12 ',
				'Theatre EC-Grade 12',
    		],

    		"Supplemental Certificate Standards" => [
				'Bilingual Education',
				'Bilingual Target Language Proficiency',
				'English as a Second Language  ',
				'Gifted and Talented (Supplemental)',
				'Teacher of Students with Visual Impairments Supplemental (includes Braille) (Grades EC-12)',
    		],

    		"Standards for All Teachers" => [
    			'Pedagogy and Professional Responsibilities (EC-Grade 12)',
				'Technology Applications (All Beginning Teachers)',
    		],

    		"Administrative Certificate Standards" => [
				'Principal (§241.15)',
				'Superintendent (§242.15)'
    		],

    		"Student Services Certificate Standards" => [
    			'Educational Diagnostician (§239.83)',
				'Reading Specialist (EC-Grade 12)',
				'School Counselor (§239.15)',
				'School Librarian (§239.55)',
    		],

    		"Master Teacher Certificate Standards" => [
				'Master Mathematics Teacher',
				'Master Reading Teacher',
				'Master Science Teacher',
				'Master Technology Teacher',
    		]
    	];

    }

    public function jobType()
    {
    	return [
    				"Full-time",
    				"Part-time",
    				"Summer",
					"Evening"
    	];
    }

    public function jobPosition()
    {
    	return [
    				"Paraprofessional (clerk, secretary, receptionist, classroom assistant etc.)",
    				"Non-teacher professional (counselor, diagnosticians, coordinators, Specialist)",
    				"Administrative (principal, AP, business manager, director, superintendent etc.)",
    				"Professional, teacher (Teacher in the classroom)",
    				"Skilled labor or trade (maintenance, bus driver, café worker etc.)"
    	];
    }

    public function jobDegreeAttained()
    {
    	return [
    				"GED/HS",
    				"College: 1-29 hrs. credit",
    				"College: 30-59+hrs credit",
    				" Associate's degree",
    				"Bachelor's degree",
    				"Masters or Doctoral"
    	];
    }

    public function teammates()
    {
    	return [
    				"Administrator",
    				"Pay Approved",
    				"Limited"
    	];
    }

}



