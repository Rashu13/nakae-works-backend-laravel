<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StateModel;
use App\Models\CityModel;

class StateCitySeeder extends Seeder
{
    /**
     * Seed India States and exhaustive A-Z Cities list for all 36 States & UTs.
     */
    public function run(): void
    {
        $statesWithCities = [
            'Andhra Pradesh' => [
                'Adoni', 'Amalapuram', 'Anakapalle', 'Anantapur', 'Bapatla', 'Chittoor', 
                'Dharmavaram', 'Eluru', 'Gudivada', 'Guntakal', 'Guntur', 'Hindupur', 
                'Jaggaiahpet', 'Kadapa', 'Kakinada', 'Kandukur', 'Kavali', 'Kurnool', 
                'Machilipatnam', 'Madanapalle', 'Mangalagiri', 'Nandyal', 'Narasaraopet', 
                'Nellore', 'Ongole', 'Proddatur', 'Rajahmundry', 'Rayachoti', 'Srikakulam', 
                'Tadepalligudem', 'Tenali', 'Tirupati', 'Vijayawada', 'Visakhapatnam', 'Vizianagaram'
            ],
            'Arunachal Pradesh' => [
                'Along (Aalo)', 'Basar', 'Bomdila', 'Changlang', 'Daporijo', 'Deomali', 
                'Itanagar', 'Jairampur', 'Khonsa', 'Naharlagun', 'Namsai', 'Pasighat', 
                'Roing', 'Seppa', 'Tawang', 'Tezu', 'Ziro'
            ],
            'Assam' => [
                'Abhayapuri', 'Barpeta', 'Biswanath Chariali', 'Bongaigaon', 'Dhemaji', 
                'Dhubri', 'Dibrugarh', 'Digboi', 'Diphu', 'Goalpara', 'Golaghat', 'Guwahati', 
                'Haflong', 'Hailakandi', 'Hojai', 'Jorhat', 'Karimganj', 'Kokrajhar', 
                'Lanka', 'Lumding', 'Mangaldoi', 'Nagaon', 'Nalbari', 'North Lakhimpur', 
                'Rangia', 'Sibsagar (Sivasagar)', 'Silchar', 'Tezpur', 'Tinsukia'
            ],
            'Bihar' => [
                'Araria', 'Arrah (Bhojpur)', 'Aurangabad', 'Bagaha', 'Banka', 'Begusarai', 
                'Bettiah', 'Bhabua', 'Bhagalpur', 'Bihar Sharif', 'Buxar', 'Chhapra', 
                'Darbhanga', 'Dehri', 'Dinapur Nizamat', 'Dumraon', 'Gaya', 'Gopalganj', 
                'Hajipur', 'Jamalpur', 'Jamui', 'Jehanabad', 'Katihar', 'Khagaria', 
                'Kishanganj', 'Lakhisarai', 'Madhubani', 'Mokama', 'Motihari', 'Munger', 
                'Muzaffarpur', 'Nawada', 'Patna', 'Purnia', 'Raxaul', 'Saharsa', 
                'Samastipur', 'Sasaram', 'Sheikhpura', 'Sheohar', 'Sitamarhi', 'Siwan', 'Supaul'
            ],
            'Chhattisgarh' => [
                'Ambikapur', 'Baikunthpur', 'Balod', 'Baloda Bazar', 'Bemetara', 'Bhatapara', 
                'Bhilai', 'Bilaspur', 'Dantewada', 'Dhamtari', 'Durg', 'Jagdalpur', 
                'Jashpur', 'Kanker', 'Kawardha (Kabirdham)', 'Khairagarh', 'Kondagaon', 
                'Korba', 'Mahasamund', 'Mungeli', 'Raigarh', 'Raipur', 'Rajnandgaon', 
                'Sukma', 'Surajpur'
            ],
            'Goa' => [
                'Bicholim', 'Canacona', 'Curchorem', 'Mapusa', 'Margao', 'Mormugao', 
                'Panaji', 'Ponda', 'Quepem', 'Sanguem', 'Sanquelim', 'Valpoi', 'Vasco da Gama'
            ],
            'Gujarat' => [
                'Ahmedabad', 'Amreli', 'Anand', 'Anjar', 'Ankleshwar', 'Bardoli', 
                'Bharuch', 'Bhavnagar', 'Bhuj', 'Botad', 'Dabhoi', 'Dahod', 'Deesa', 
                'Dhoraji', 'Dhrangadhra', 'Dwarka', 'Gandhidham', 'Gandhinagar', 'Godhra', 
                'Gondal', 'Himatnagar', 'Idar', 'Jamnagar', 'Jetpur', 'Junagadh', 
                'Kadi', 'Kalol', 'Keshod', 'Khambhat', 'Limbdi', 'Lunawada', 'Mehsana', 
                'Modasa', 'Morbi', 'Nadiad', 'Navsari', 'Palanpur', 'Patan', 'Porbandar', 
                'Rajkot', 'Rajpipla', 'Siddhpur', 'Surat', 'Surendranagar', 'Talaja', 
                'Umreth', 'Unjha', 'Vadodara', 'Vapi', 'Veraval', 'Visnagar', 'Wankaner'
            ],
            'Haryana' => [
                'Ambala', 'Ambala Cantt', 'Assandh', 'Bahadurgarh', 'Bhiwani', 'Charkhi Dadri', 
                'Dabwali', 'Ellenabad', 'Faridabad', 'Fatehabad', 'Gohana', 'Gurugram (Gurgaon)', 
                'Hansi', 'Hisar', 'Jhajjar', 'Jind', 'Kaithal', 'Kalka', 'Karnal', 
                'Kurukshetra', 'Narnaul', 'Narwana', 'Palwal', 'Panchkula', 'Panipat', 
                'Pehowa', 'Rewari', 'Rohtak', 'Sirsa', 'Sonipat', 'Tohana', 'Yamunanagar'
            ],
            'Himachal Pradesh' => [
                'Baddi', 'Bilaspur', 'Chamba', 'Dalhousie', 'Dharamshala', 'Hamirpur', 
                'Kangra', 'Kullu', 'Manali', 'Mandi', 'Nahan', 'Palampur', 'Paonta Sahib', 
                'Rampur', 'Shimla', 'Solan', 'Sundarnagar', 'Una'
            ],
            'Jharkhand' => [
                'Adityapur', 'Baghmara', 'Chaibasa', 'Chakradharpur', 'Chatra', 'Deoghar', 
                'Dhanbad', 'Dumka', 'Garhwa', 'Giridih', 'Godda', 'Gumla', 'Hazaribagh', 
                'Jamshedpur', 'Jhumri Telaiya', 'Khunti', 'Koderma', 'Latehar', 'Lohardaga', 
                'Medininagar (Daltonganj)', 'Pakur', 'Ramgarh', 'Ranchi', 'Sahibganj', 'Simdega'
            ],
            'Karnataka' => [
                'Bagalkot', 'Ballari (Bellary)', 'Belagavi (Belgaum)', 'Bengaluru (Bangalore)', 
                'Bhadravati', 'Bidar', 'Chamarajanagar', 'Chikkaballapur', 'Chikkamagaluru', 
                'Chitradurga', 'Davanagere', 'Dharwad', 'Gadag', 'Gokak', 'Hassan', 'Haveri', 
                'Hosapete', 'Hubballi (Hubli)', 'Ilkal', 'Karwar', 'Kolar', 'Koppal', 'Mandya', 
                'Mangaluru (Mangalore)', 'Mysuru (Mysore)', 'Nipani', 'Raichur', 'Ramanagara', 
                'Ranibennur', 'Sagar', 'Shahabad', 'Shivamogga (Shimoga)', 'Sirsi', 
                'Tumakuru (Tumkur)', 'Udupi', 'Vijayapura (Bijapur)', 'Yadgir'
            ],
            'Kerala' => [
                'Alappuzha', 'Angamaly', 'Attingal', 'Chalakudy', 'Changanassery', 'Cherthala', 
                'Guruvayur', 'Irinjalakuda', 'Kanhangad', 'Kannur', 'Karunagappalli', 'Kasaragod', 
                'Kayamkulam', 'Kochi (Cochin)', 'Kodungallur', 'Kollam', 'Kothamangalam', 
                'Kottayam', 'Kozhikode (Calicut)', 'Kunnamkulam', 'Malappuram', 'Manjeri', 
                'Nedumangad', 'Neyyattinkara', 'Nilambur', 'Ottapalam', 'Pala', 'Palakkad', 
                'Payyanur', 'Perinthalmanna', 'Punalur', 'Thiruvananthapuram (Trivandrum)', 
                'Thodupuzha', 'Thrissur', 'Tirur', 'Vadakara', 'Varkala'
            ],
            'Madhya Pradesh' => [
                'Ashoknagar', 'Balaghat', 'Barwani', 'Betul', 'Bhind', 'Bhopal', 'Burhanpur', 
                'Chhatarpur', 'Chhindwara', 'Damoh', 'Datia', 'Dewas', 'Dhar', 'Guna', 
                'Gwalior', 'Harda', 'Hoshangabad (Narmadapuram)', 'Indore', 'Jabalpur', 'Jaora', 
                'Katni', 'Khandwa', 'Khargone', 'Mandla', 'Mandsaur', 'Morena', 'Nagda', 
                'Narsinghpur', 'Neemuch', 'Panna', 'Pipariya', 'Ratlam', 'Rewa', 'Sagar', 
                'Satna', 'Sehore', 'Sendhwa', 'Seoni', 'Shahdol', 'Shajapur', 'Sheopur', 
                'Shivpuri', 'Sidhi', 'Singrauli', 'Tikamgarh', 'Ujjain', 'Vidisha'
            ],
            'Maharashtra' => [
                'Achalpur', 'Ahmednagar (Ahilya Nagar)', 'Akola', 'Alibag', 'Amalner', 'Amravati', 
                'Anjangaon', 'Baramati', 'Beed', 'Bhandara', 'Bhiwandi', 'Bhusawal', 'Buldhana', 
                'Chandrapur', 'Chhatrapati Sambhaji Nagar (Aurangabad)', 'Chiplun', 'Dhule', 
                'Dombivli', 'Gadchiroli', 'Gondia', 'Hinganghat', 'Hingoli', 'Ichalkaranji', 
                'Jalgaon', 'Jalna', 'Kalyan', 'Karad', 'Khamgaon', 'Khopoli', 'Kolhapur', 
                'Latur', 'Lonavala', 'Malegaon', 'Malkapur', 'Mira-Bhayandar', 'Miraj', 
                'Mumbai', 'Nagpur', 'Nanded', 'Nandurbar', 'Nashik', 'Navi Mumbai', 
                'Osmanabad (Dharashiv)', 'Palghar', 'Pandharpur', 'Parbhani', 'Pen', 'Phaltan', 
                'Pimpri-Chinchwad', 'Pune', 'Ratnagiri', 'Sangamner', 'Sangli', 'Satara', 
                'Sawantwadi', 'Shahada', 'Shirdi', 'Shirpur', 'Solapur', 'Thane', 'Udgir', 
                'Vasai-Virar', 'Wardha', 'Washim', 'Yavatmal'
            ],
            'Manipur' => [
                'Bishnupur', 'Churachandpur', 'Imphal', 'Jiribam', 'Kakching', 'Senapati', 
                'Tamenglong', 'Thoubal', 'Ukhrul'
            ],
            'Meghalaya' => [
                'Baghmara', 'Jowai', 'Nongpoh', 'Nongstoin', 'Resubelpara', 'Shillong', 'Tura', 'Williamnagar'
            ],
            'Mizoram' => [
                'Aizawl', 'Champhai', 'Kolasib', 'Lawngtlai', 'Lunglei', 'Mamit', 'Saiha', 'Serchhip'
            ],
            'Nagaland' => [
                'Chumoukedima', 'Dimapur', 'Kiphire', 'Kohima', 'Mokokchung', 'Mon', 'Peren', 
                'Phek', 'Tuensang', 'Wokha', 'Zunheboto'
            ],
            'Odisha' => [
                'Angul', 'Balangir', 'Balasore', 'Bargarh', 'Baripada', 'Berhampur', 'Bhadrak', 
                'Bhawanipatna', 'Bhubaneswar', 'Byasanagar', 'Cuttack', 'Jajpur', 'Jeypore', 
                'Jharsuguda', 'Kendrapara', 'Keonjhar', 'Koraput', 'Nabarangpur', 'Nayagarh', 
                'Paradip', 'Paralakhemundi', 'Puri', 'Rayagada', 'Rourkela', 'Sambalpur', 
                'Sunabeda', 'Talcher'
            ],
            'Punjab' => [
                'Abohar', 'Ahmedgarh', 'Amritsar', 'Barnala', 'Batala', 'Bathinda', 'Dhuri', 
                'Faridkot', 'Fazilka', 'Firozpur', 'Gurdaspur', 'Hoshiarpur', 'Jagraon', 
                'Jalandhar', 'Kapurthala', 'Khanna', 'Kharar', 'Kotkapura', 'Ludhiana', 
                'Malerkotla', 'Mandi Gobindgarh', 'Mansa', 'Moga', 'Mohali (SAS Nagar)', 
                'Muktsar', 'Nawanshahr', 'Pathankot', 'Patiala', 'Phagwara', 'Rajpura', 
                'Roopnagar (Ropar)', 'Sangrur', 'Sunam', 'Tarn Taran'
            ],
            'Rajasthan' => [
                'Abu Road', 'Ajmer', 'Alwar', 'Anupgarh', 'Banswara', 'Baran', 'Barmer', 
                'Beawar', 'Bharatpur', 'Bhilwara', 'Bikaner', 'Bundi', 'Chittorgarh', 'Churu', 
                'Dausa', 'Dholpur', 'Dungarpur', 'Hanumangarh', 'Hindaun', 'Jaipur', 'Jaisalmer', 
                'Jalore', 'Jhalawar', 'Jhunjhunu', 'Jodhpur', 'Karauli', 'Kishangarh', 'Kota', 
                'Makrana', 'Nagaur', 'Nokha', 'Pali', 'Phalodi', 'Pratapgarh', 'Rajsamand', 
                'Ratangarh', 'Sawai Madhopur', 'Shahpura', 'Sikar', 'Sirohi', 'Sri Ganganagar', 
                'Sujangarh', 'Suratgarh', 'Tonk', 'Udaipur'
            ],
            'Sikkim' => [
                'Gangtok', 'Geyzing', 'Mangan', 'Namchi', 'Pakyong', 'Rangpo', 'Singtam'
            ],
            'Tamil Nadu' => [
                'Ambur', 'Arakkonam', 'Ariyalur', 'Chengalpattu', 'Chennai', 'Coimbatore', 
                'Cuddalore', 'Dharmapuri', 'Dindigul', 'Erode', 'Hosur', 'Kanchipuram', 
                'Karaikudi', 'Karur', 'Krishnagiri', 'Kumbakonam', 'Madurai', 'Mayiladuthurai', 
                'Nagapattinam', 'Nagercoil', 'Namakkal', 'Neyveli', 'Ooty (Udhagamandalam)', 
                'Palani', 'Perambalur', 'Pollachi', 'Pudukkottai', 'Rajapalayam', 
                'Ramanathapuram', 'Ranipet', 'Salem', 'Sivakasi', 'Thanjavur', 'Thenkasi', 
                'Theni', 'Thoothukudi (Tuticorin)', 'Tiruchirappalli (Trichy)', 'Tirunelveli', 
                'Tirupathur', 'Tiruppur', 'Tiruvallur', 'Tiruvannamalai', 'Tiruvarur', 
                'Vellore', 'Viluppuram', 'Virudhunagar'
            ],
            'Telangana' => [
                'Adilabad', 'Armoor', 'Bellampalle', 'Bhadrachalam', 'Bhongir', 'Bodhan', 
                'Gadwal', 'Hyderabad', 'Jagtial', 'Jangaon', 'Kamareddy', 'Karimnagar', 
                'Khammam', 'Kothagudem', 'Mahbubnagar', 'Mancherial', 'Mandamarri', 'Medak', 
                'Miryalaguda', 'Nalgonda', 'Narayanpet', 'Nirmal', 'Nizamabad', 'Palwancha', 
                'Peddapalli', 'Ramagundam', 'Sangareddy', 'Siddipet', 'Suryapet', 'Tandur', 
                'Vikarabad', 'Wanaparthy', 'Warangal', 'Zaheerabad'
            ],
            'Tripura' => [
                'Agartala', 'Belonia', 'Bishalgarh', 'Dharmanagar', 'Kailashahar', 'Khowai', 
                'Ranirbazar', 'Sabroom', 'Santirbazar', 'Teliamura', 'Udaipur'
            ],
            'Uttar Pradesh' => [
                'Agra', 'Aligarh', 'Amroha', 'Ayodhya (Faizabad)', 'Azamgarh', 'Baghpat', 
                'Baheri', 'Bahraich', 'Ballia', 'Balrampur', 'Banda', 'Barabanki', 'Bareilly', 
                'Basti', 'Bijnor', 'Budaun', 'Bulandshahr', 'Chandausi', 'Deoria', 'Etah', 
                'Etawah', 'Fatehpur', 'Firozabad', 'Ghaziabad', 'Ghazipur', 'Gonda', 
                'Gorakhpur', 'Hapur', 'Hardoi', 'Hathras', 'Jaunpur', 'Jhansi', 'Kannauj', 
                'Kanpur', 'Kasganj', 'Kheri (Lakhimpur)', 'Khurja', 'Lalitpur', 'Loni', 
                'Lucknow', 'Mathura', 'Mau', 'Meerut', 'Mirzapur', 'Modinagar', 'Moradabad', 
                'Muzaffarnagar', 'Nagina', 'Najibabad', 'Noida', 'Orai', 'Pilibhit', 
                'Prayagraj (Allahabad)', 'Rae Bareli', 'Rampur', 'Saharanpur', 'Sambhal', 
                'Shahjahanpur', 'Shamli', 'Shikohabad', 'Sitapur', 'Sultanpur', 'Unnao', 
                'Varanasi', 'Vrindavan'
            ],
            'Uttarakhand' => [
                'Almora', 'Bageshwar', 'Chamoli', 'Champawat', 'Dehradun', 'Gopeshwar', 
                'Haldwani', 'Haridwar', 'Jaspur', 'Kashipur', 'Khatima', 'Kotdwar', 
                'Mussoorie', 'Nainital', 'Pauri', 'Pithoragarh', 'Ramnagar', 'Rishikesh', 
                'Roorkee', 'Rudrapur', 'Tehri', 'Vikas Nagar'
            ],
            'West Bengal' => [
                'Alipurduar', 'Asansol', 'Baharampur', 'Balurghat', 'Bankura', 'Barasat', 
                'Bardhaman', 'Barrackpore', 'Basirhat', 'Berhampore', 'Bishnupur', 'Bolpur', 
                'Burnpur', 'Contai (Kanthi)', 'Cooch Behar', 'Darjeeling', 'Dhulian', 
                'Durgapur', 'English Bazar (Malda)', 'Habra', 'Haldia', 'Howrah', 'Jalpaiguri', 
                'Jangipur', 'Jhargram', 'Kalyani', 'Kharagpur', 'Kolkata', 'Krishnanagar', 
                'Medinipur (Midnapore)', 'Nabadwip', 'Purulia', 'Raiganj', 'Ranaghat', 
                'Rishra', 'Santipur', 'Serampore', 'Siliguri', 'Suri'
            ],
            'Delhi (NCT)' => [
                'Central Delhi', 'East Delhi', 'New Delhi', 'North Delhi', 'North East Delhi', 
                'North West Delhi', 'Shahdara', 'South Delhi', 'South East Delhi', 
                'South West Delhi', 'West Delhi'
            ],
            'Chandigarh' => [
                'Chandigarh', 'Manimajra'
            ],
            'Jammu & Kashmir' => [
                'Anantnag', 'Bandipora', 'Baramulla', 'Budgam', 'Doda', 'Ganderbal', 
                'Jammu', 'Kathua', 'Kishtwar', 'Kulgam', 'Kupwara', 'Poonch', 'Pulwama', 
                'Rajouri', 'Ramban', 'Reasi', 'Samba', 'Shopian', 'Srinagar', 'Udhampur'
            ],
            'Ladakh' => [
                'Diskit', 'Kargil', 'Leh', 'Padum'
            ],
            'Puducherry' => [
                'Karaikal', 'Mahe', 'Ozhukarai', 'Puducherry', 'Yanam'
            ],
            'Andaman and Nicobar' => [
                'Bambooflat', 'Car Nicobar', 'Diglipur', 'Garacharma', 'Mayabunder', 'Port Blair'
            ],
            'Dadra and Nagar Haveli and Daman and Diu' => [
                'Daman', 'Diu', 'Silvassa'
            ],
            'Lakshadweep' => [
                'Agatti', 'Amini', 'Andrott', 'Kavaratti', 'Minicoy'
            ],
        ];

        // List of major metro/hub cities to highlight on App Home by default
        $featuredHomeCities = [
            'Mumbai', 'Delhi (NCT)', 'New Delhi', 'Bengaluru (Bangalore)', 'Hyderabad', 
            'Ahmedabad', 'Chennai', 'Kolkata', 'Surat', 'Pune', 'Jaipur', 'Lucknow', 
            'Indore', 'Chandigarh', 'Bhopal', 'Patna', 'Visakhapatnam', 'Kochi (Cochin)', 
            'Guwahati', 'Bhubaneswar', 'Dehradun', 'Ludhiana', 'Varanasi', 'Vadodara'
        ];

        foreach ($statesWithCities as $stateName => $cities) {
            $state = StateModel::firstOrCreate(
                ['name' => $stateName],
                ['status' => 1, 'in_home' => 1]
            );

            foreach ($cities as $cityName) {
                $isHome = in_array($cityName, $featuredHomeCities) ? 1 : 0;

                CityModel::firstOrCreate(
                    [
                        'state_id' => $state->id,
                        'city_name' => $cityName
                    ],
                    [
                        'status' => 1,
                        'in_home' => $isHome
                    ]
                );
            }
        }
    }
}
