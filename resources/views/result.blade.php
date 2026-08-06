<x-app-layout>
    @php
    $resultsData = [
        [
            "id" => 1, "regNo" => "REG001", "name" => "Aman Kumar", "Gender" => "Male", "rollNo" => "1001",
            "fatherName" => "Ramesh Kumar", "dateOfBirth" => "15-08-2005", "schoolName" => "Bright Future Public School",
            "examDate" => "15 July 2026", "examStartTime" => "10:00 AM", "examEndTime" => "1:00 PM",
            "center" => "Lucknow Center", "category" => "Quiz", "score" => 92, "rank" => 1,
            "image" => "images/1000262516.jpg.jpeg", "classGroup" => "5-10"
        ],
        [
            "id" => 2, "regNo" => "REG002", "name" => "Priya Sharma", "Gender" => "Female", "rollNo" => "1002",
            "fatherName" => "Mahesh Singh", "dateOfBirth" => "22-11-2006", "schoolName" => "Sunrise High School",
            "examDate" => "15 July 2026", "examStartTime" => "10:00 AM", "examEndTime" => "1:00 PM",
            "center" => "New Delhi Center", "category" => "Dance", "score" => 88, "rank" => 2,
            "image" => "images/1000262516.jpg.jpeg", "classGroup" => "5-10"
        ],
        [
            "id" => 3, "regNo" => "REG003", "name" => "Rohit Singh", "Gender" => "Male", "rollNo" => "1003",
            "fatherName" => "Suresh Sharma", "dateOfBirth" => "05-03-2005", "schoolName" => "National Academy School",
            "examDate" => "15 July 2026", "examStartTime" => "10:00 AM", "examEndTime" => "1:00 PM",
            "center" => "Muzaffarpur Center", "category" => "Singing", "score" => 85, "rank" => 3,
            "image" => "images/1000262516.jpg.jpeg", "classGroup" => "11-12"
        ],
        [
            "id" => 4, "regNo" => "REG004", "name" => "Neha Verma", "Gender" => "Female", "rollNo" => "1004",
            "fatherName" => "Rajesh Verma", "dateOfBirth" => "10-07-2006", "schoolName" => "Modern Public School",
            "examDate" => "15 July 2026", "examStartTime" => "10:00 AM", "examEndTime" => "1:00 PM",
            "center" => "Patna Center", "category" => "Painting", "score" => 79, "rank" => 4,
            "image" => "images/1000262516.jpg.jpeg", "classGroup" => "11-12"
        ],
    ];

    $topWinners = collect($resultsData)->sortBy('rank')->take(3);
    @endphp

    <div class="pt-24 pb-12" x-data="{ 
            resultsData: {{ json_encode($resultsData) }},
            searchTerm: '',
            searchResultRegNo: '',
            searchResultName: '',
            searchStudentResult: null,
            searchAdmitRegNo: '',
            searchAdmitName: '',
            searchAdmitStudent: null,
            get filteredData() {
                if(!this.searchTerm) return this.resultsData;
                return this.resultsData.filter(student => student.regNo.toLowerCase().includes(this.searchTerm.toLowerCase()));
            },
            searchCertificate() {
                const found = this.resultsData.find(s => 
                    s.name.toLowerCase().trim() === this.searchResultName.toLowerCase().trim() && 
                    s.regNo.toLowerCase().trim() === this.searchResultRegNo.toLowerCase().trim()
                );
                this.searchStudentResult = found ? found : false;
            },
            searchAdmitCard() {
                const found = this.resultsData.find(s => 
                    s.name.toLowerCase().trim() === this.searchAdmitName.toLowerCase().trim() && 
                    s.regNo.toLowerCase().trim() === this.searchAdmitRegNo.toLowerCase().trim()
                );
                if(found) {
                    this.searchAdmitStudent = found;
                } else {
                    alert('No Admit Card Found');
                    this.searchAdmitStudent = null;
                }
            },
            downloadPdf(elementId, filename) {
                const element = document.getElementById(elementId);
                if(element) {
                    html2pdf().from(element).save(filename);
                }
            },
            downloadCertificateHtml(student) {
                // Generates HTML string similar to React implementation
                return `
                <div style='font-family: Arial, sans-serif; background: #eef4f8; padding: 24px; color: #1f2937;'>
                  <div style='max-width: 900px; margin: auto; background: #fff; border-radius: 18px; overflow: hidden; border: 1px solid #dbe4ea; box-shadow: 0 10px 25px rgba(0,0,0,0.08);'>
                    <div style='background: linear-gradient(135deg, #028CD4, #026aa1); color: white; padding: 24px 30px;'>
                      <div style='display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap;'>
                        <div>
                          <div style='display:flex; align-items:center; gap:10px;'>
                            <img src='${'{{ asset('logo/logo.jpeg') }}'}' alt='logo' style='height: 40px; width: 40px; border-radius: 50%; object-fit: contain; box-shadow: 0 4px 6px rgba(0,0,0,0.1);' />
                            <h1 style='margin-bottom:20px; font-size: 28px; font-weight: 700; display: flex; align-items: center; gap: 6px;'>
                              <span style='color:#340C6F;'>YOUTH</span> <span style='color:#F1400C;'>REVOLUTIONARY</span>
                            </h1>
                          </div>
                        </div>
                        <div style='padding: 5px 8px; border-radius: 8px; min-width: 180px;'>
                          <p style='margin: 0; font-size: 12px; opacity: 0.9;'>Registration No</p>
                          <p style='margin: 3px 0 0; font-size: 15px; font-weight: 700;'>${student.regNo}</p>
                        </div>
                      </div>
                    </div>
                    <div style='padding: 28px;'>
                      <div style='display: flex; gap: 20px; align-items: center; border: 1px solid #e5e7eb; border-radius: 16px; padding: 20px; background: #f9fbfc; margin-bottom: 24px;'>
                        <div>
                          <img src='${'{{ asset('') }}' + student.image}' alt='${student.name}' style='width: 90px; height: 90px; object-fit: cover; border-radius: 50%; border: 3px solid #dbeafe; background: #fff;' />
                        </div>
                        <div style='flex: 1;'>
                          <h2 style='margin: 0; font-size: 26px; color: #111827; font-weight: 700;'>${student.name}</h2>
                          <div style='display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; margin-top: 14px;'>
                            <div><p style='margin: 0; font-size: 12px; color: #6b7280;'>Competition</p><p style='margin: 4px 0 0; font-size: 16px; font-weight: 600;'>${student.category}</p></div>
                            <div><p style='margin: 0; font-size: 12px; color: #6b7280;'>Rank</p><p style='margin: 4px 0 0; font-size: 16px; font-weight: 600;'>#${student.rank}</p></div>
                            <div><p style='margin: 0; font-size: 12px; color: #6b7280;'>Result Status</p><p style='margin: 4px 0 0; font-size: 16px; font-weight: 700; color: #16a34a;'>Qualified</p></div>
                            <div><p style='margin: 0; font-size: 12px; color: #6b7280;'>Total Score</p><p style='margin: 4px 0 0; font-size: 18px; font-weight: 700; color: #028CD4;'>${student.score}</p></div>
                          </div>
                        </div>
                      </div>
                      <div style='border: 1px solid #e5e7eb; border-radius: 16px; overflow: hidden; margin-bottom: 24px;'>
                        <div style='background: #f3f4f6; padding: 14px 18px; border-bottom: 1px solid #e5e7eb;'><h3 style='margin: 0; font-size: 18px; color: #111827;'>Result Summary</h3></div>
                        <table style='width: 100%; border-collapse: collapse; font-size: 15px;'>
                          <thead><tr style='background: #fafafa;'><th style='padding: 14px; text-align: left; border-bottom: 1px solid #e5e7eb;'>Particular</th><th style='padding: 14px; text-align: left; border-bottom: 1px solid #e5e7eb;'>Details</th></tr></thead>
                          <tbody>
                            <tr><td style='padding: 14px; font-weight: 600;'>Student Name</td><td style='padding: 14px;'>${student.name}</td></tr>
                            <tr><td style='padding: 14px; font-weight: 600;'>Registration Number</td><td style='padding: 14px;'>${student.regNo}</td></tr>
                            <tr><td style='padding: 14px; font-weight: 600;'>Competition</td><td style='padding: 14px;'>${student.category}</td></tr>
                            <tr><td style='padding: 14px; font-weight: 600;'>Score Obtained</td><td style='padding: 14px;'>${student.score}</td></tr>
                            <tr><td style='padding: 14px; font-weight: 600;'>Rank</td><td style='padding: 14px;'>#${student.rank}</td></tr>
                            <tr><td style='padding: 14px; font-weight: 600;'>Final Result</td><td style='padding: 14px; color: #16a34a; font-weight: 700;'>Qualified</td></tr>
                          </tbody>
                        </table>
                      </div>
                      <div style='background: #f9fafb; border: 1px solid #e5e7eb; border-left: 5px solid #028CD4; border-radius: 14px; padding: 18px; margin-bottom: 34px;'>
                        <p style='margin: 0; font-size: 13px; color: #6b7280;'>Remarks</p>
                        <p style='margin: 8px 0 0; line-height: 1.7; font-size: 15px;'>${student.name} has successfully completed the competition/examination in <strong>${student.category}</strong> and secured <strong>Rank #${student.rank}</strong> with a score of <strong>${student.score}</strong>.</p>
                      </div>
                      <div style='display: flex; justify-content: space-between; align-items: flex-end; gap: 20px; margin-top: 30px;'>
                        <div style='text-align: center; width: 220px;'><div style='border-top: 1px solid #111827; margin-bottom: 8px;'></div><p style='margin: 0; font-weight: 600;'>Coordinator</p></div>
                        <div style='text-align: center; width: 220px;'><div style='border-top: 1px solid #111827; margin-bottom: 8px;'></div><p style='margin: 0; font-weight: 600;'>Authority</p></div>
                      </div>
                    </div>
                  </div>
                </div>`;
            },
            triggerHtmlDownload(student) {
                const html = this.downloadCertificateHtml(student);
                const container = document.createElement('div');
                container.innerHTML = html;
                html2pdf().from(container).save(`${student.regNo || 'certificate'}.pdf`);
            }
        }">
        <section class="max-w-7xl mx-auto px-4 sm:px-6">
            
            <!-- Results Header (Top Winners) -->
            <div x-data="{ show: false }" x-intersect.once="show = true" x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
                <section class="mb-20 m-6">
                    <h2 class="text-4xl font-bold text-center my-16">🏆 Top 3 Champions</h2>
                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach($topWinners as $winner)
                            @php
                                $ringClass = $winner['rank'] === 1 ? 'ring-4 ring-yellow-400' : ($winner['rank'] === 2 ? 'ring-4 ring-gray-300' : 'ring-4 ring-orange-400');
                                $badgeClass = $winner['rank'] === 1 ? 'bg-yellow-500' : ($winner['rank'] === 2 ? 'bg-gray-500' : 'bg-orange-500');
                                $iconBgClass = $winner['rank'] === 1 ? 'bg-yellow-100' : ($winner['rank'] === 2 ? 'bg-gray-100' : 'bg-orange-100');
                                $iconColorClass = $winner['rank'] === 1 ? 'text-yellow-500' : ($winner['rank'] === 2 ? 'text-gray-500' : 'text-orange-500');
                            @endphp
                            <div class="relative bg-white rounded-lg overflow-hidden hover:shadow-2xl hover:-translate-y-3 transition-all duration-300 {{ $ringClass }}">
                                <!-- Header -->
                                <div class="relative h-32 bg-[#028CD4] overflow-hidden">
                                    <i class="fa-solid fa-trophy absolute top-3 left-4 text-white/20 text-6xl"></i>
                                    <i class="fa-solid fa-award absolute top-4 right-10 text-white/20 text-5xl"></i>
                                    <i class="fa-solid fa-star absolute bottom-4 left-16 text-white/20 text-3xl"></i>
                                    <i class="fa-solid fa-medal absolute bottom-3 right-5 text-white/20 text-4xl"></i>
                                    <div class="absolute -top-10 -left-10 w-28 h-28 rounded-full bg-white/10"></div>
                                    <div class="absolute -bottom-10 -right-10 w-36 h-36 rounded-full bg-white/20"></div>
                                </div>
                                
                                <!-- Rank Badge -->
                                <div class="absolute top-4 right-4 z-20">
                                    <span class="px-4 py-2 rounded-full text-white font-bold shadow-lg {{ $badgeClass }}">
                                        🏆 #{{ $winner['rank'] }}
                                    </span>
                                </div>
                                
                                <!-- Profile Image -->
                                <div class="relative flex justify-center -mt-14 z-10">
                                    <div class="relative">
                                        <img src="{{ asset($winner['image']) }}" alt="{{ $winner['name'] }}" class="w-32 h-32 rounded-full border-4 border-white shadow-xl object-cover" />
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="p-6 text-center">
                                    <div class="flex justify-center mb-4">
                                        <div class="p-3 rounded-full h-28 w-28 relative {{ $iconBgClass }}">
                                            <i class="fa-solid fa-trophy text-[3.5rem] absolute left-7 top-6 {{ $iconColorClass }}"></i>
                                        </div>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $winner['name'] }}</h3>
                                    <p class="text-[#028CD4] font-semibold mt-2">{{ $winner['category'] }}</p>
                                    <p class="text-gray-500 mt-1">Reg No: {{ $winner['regNo'] }}</p>
                                    <div class="flex justify-center gap-3 mt-5 flex-wrap">
                                        <div class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">🎯 Score: {{ $winner['score'] }}</div>
                                        <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">🏅 Rank #{{ $winner['rank'] }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <!-- Admit Card -->
            <div x-data="{ show: false }" x-intersect.once="show = true" x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="max-w-5xl mx-auto py-10 px-4">
                    <div class="bg-white rounded-3xl p-8 shadow">
                        <h2 class="text-3xl font-bold text-[#028CD4] mb-6">Admit Card Download</h2>
                        <form @submit.prevent="searchAdmitCard" class="grid md:grid-cols-2 gap-5">
                            <div>
                                <label class="block mb-2 font-medium">Registration Number</label>
                                <input type="text" placeholder="Enter Registration No." x-model="searchAdmitRegNo" required class="w-full border-2 border-gray-100 p-4 rounded-xl focus:outline-[#028CD4]" />
                            </div>
                            <div>
                                <label class="block mb-2 font-medium">Student Name</label>
                                <input type="text" placeholder="Enter Full Name" x-model="searchAdmitName" required class="w-full border-2 border-gray-100 p-4 rounded-xl focus:outline-[#028CD4]" />
                            </div>
                            <div class="md:col-span-2">
                                <button type="submit" class="w-full bg-[#028CD4] text-white py-4 cursor-pointer rounded-xl font-semibold">
                                    View Admit Card
                                </button>
                                <div class="mt-8 flex gap-3">
                                    <button type="button" @click="downloadPdf('admit-card-print', searchAdmitStudent.regNo + '.pdf')" x-show="searchAdmitStudent" class="flex-1 text-center hover:text-blue-700 cursor-pointer bg-white text-gray-800 py-4 mb-5 rounded-xl border font-semibold">
                                        Download PDF
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div x-show="searchAdmitStudent" style="display: none;" class="mt-10 overflow-x-auto w-full">
                            <div id="admit-card-print" class="bg-white rounded-3xl overflow-hidden shadow-2xl border border-gray-200 min-w-[800px]" style="width: 1000px; margin: 0 auto;">
                                <div class="bg-[#028CD4] text-white p-8">
                                    <div class="flex flex-row justify-between items-center">
                                        <div class="flex flex-row items-center gap-4">
                                            <img src="{{ asset('logo/logo.jpeg') }}" alt="Logo" class="w-16 h-16 object-contain rounded-full" />
                                            <div class="text-center md:text-left">
                                                <h1 class="text-3xl font-bold uppercase">Youth Revolutionary</h1>
                                                <p class="text-blue-100 text-sm tracking-widest">OFFICIAL EXAMINATION ADMIT CARD</p>
                                            </div>
                                        </div>
                                        <div class="mt-4 md:mt-0 bg-white text-[#028CD4] px-6 py-2 rounded-full font-bold">ADMIT CARD</div>
                                    </div>
                                </div>
                                <div class="p-8 text-left">
                                    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 30px;">
                                        <div class="flex-1">
                                            <h2 class="text-xl font-bold mb-5 text-gray-800 border-b pb-3">Candidate Information</h2>
                                            <div class="grid grid-cols-2 gap-3">
                                                <div class="bg-gray-50 p-2 rounded-xl"><p class="text-sm text-gray-500">Student Name</p><h3 class="font-semibold text-lg" x-text="searchAdmitStudent?.name"></h3></div>
                                                <div class="bg-gray-50 p-2 rounded-xl"><p class="text-sm text-gray-500">Father's Name</p><h3 class="font-semibold text-lg" x-text="searchAdmitStudent?.fatherName"></h3></div>
                                                <div class="bg-gray-50 p-2 rounded-xl"><p class="text-sm text-gray-500">DOB</p><h3 class="font-semibold text-lg" x-text="searchAdmitStudent?.dateOfBirth"></h3></div>
                                                <div class="bg-gray-50 p-2 rounded-xl"><p class="text-sm text-gray-500">Registration No.</p><h3 class="font-semibold text-lg" x-text="searchAdmitStudent?.regNo"></h3></div>
                                                <div class="bg-gray-50 p-2 rounded-xl"><p class="text-sm text-gray-500">Roll Number</p><h3 class="font-semibold text-lg" x-text="searchAdmitStudent?.rollNo"></h3></div>
                                                <div class="bg-gray-50 p-2 rounded-xl"><p class="text-sm text-gray-500">Gender</p><h3 class="font-semibold text-lg" x-text="searchAdmitStudent?.Gender"></h3></div>
                                            </div>
                                            <div class="mt-5 bg-green-50 border border-gray-100 p-2 rounded-xl">
                                                <p class="text-sm text-gray-500">School Name/Institute</p>
                                                <h3 class="font-bold text-lg" x-text="searchAdmitStudent?.schoolName"></h3>
                                            </div>
                                        </div>
                                        <div style="width: 180px; min-width: 180px; display: flex; justify-content: center;">
                                            <div class="border-3 border-[#028CD4] rounded-sm overflow-hidden">
                                                <img :src="searchAdmitStudent ? '{{ asset('') }}' + searchAdmitStudent.image : ''" style="width: 120px; height: 170px; object-fit: cover;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-8">
                                        <h2 class="text-xl font-bold mb-5 text-gray-800 border-b pb-3">Examination Details</h2>
                                        <div class="grid grid-cols-3 gap-5">
                                            <div class="bg-blue-50 border border-blue-100 p-5 rounded-xl"><p class="text-sm text-gray-500">Exam Date</p><h3 class="font-bold text-lg" x-text="searchAdmitStudent?.examDate"></h3></div>
                                            <div class="bg-blue-50 border border-blue-100 p-5 rounded-xl"><p class="text-sm text-gray-500">Exam Time</p><h3 class="font-bold text-lg" x-text="searchAdmitStudent?.examStartTime + ' - ' + searchAdmitStudent?.examEndTime"></h3></div>
                                            <div class="bg-blue-50 border border-blue-100 p-5 rounded-xl"><p class="text-sm text-gray-500">Reporting Time</p><h3 class="font-bold text-lg">09:00 AM</h3></div>
                                        </div>
                                        <div class="mt-5 bg-gray-50 border p-5 rounded-xl">
                                            <p class="text-sm text-gray-500">Examination Center</p>
                                            <h3 class="font-bold text-lg" x-text="searchAdmitStudent?.center"></h3>
                                        </div>
                                    </div>
                                    <div class="mt-8">
                                        <h2 class="text-xl font-bold mb-4">Important Instructions</h2>
                                        <ul class="space-y-2 text-gray-600 list-disc pl-5">
                                            <li>Carry this admit card to the examination center.</li>
                                            <li>Bring a valid photo identity proof.</li>
                                            <li>Reach the center at least 30 minutes before reporting time.</li>
                                            <li>Mobile phones and electronic devices are prohibited.</li>
                                        </ul>
                                    </div>
                                    <div class="mt-14 flex justify-between">
                                        <div class="text-center"><div class="w-40 border-b-2 border-gray-400"></div><p class="mt-2 font-medium">Candidate Signature</p></div>
                                        <div class="text-center"><div class="w-40 border-b-2 border-gray-400"></div><p class="mt-2 font-medium">Authorized Signatory</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search (Certificate) -->
            <div x-data="{ show: false }" x-intersect.once="show = true" x-show="show" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
                <section class="py-16 text-left">
                    <div class="max-w-7xl mx-auto px-6">
                        <div class="bg-white rounded-3xl overflow-hidden shadow">
                            <div :class="searchStudentResult ? 'block' : 'grid lg:grid-cols-2'">
                                <!-- LEFT SIDE FORM -->
                                <div x-show="!searchStudentResult" class="bg-[#028CD4] p-10 text-white">
                                    <h2 class="text-4xl font-bold mb-3">Your Certificate</h2>
                                    <p class="mb-8 text-blue-100">Enter your Name and Registration Number to view your competition Certificate.</p>
                                    <form @submit.prevent="searchCertificate" class="space-y-5">
                                        <div>
                                            <input type="text" placeholder="Student Name" x-model="searchResultName" required class="w-full p-4 rounded-xl text-black bg-white" />
                                        </div>
                                        <div>
                                            <input type="text" placeholder="Registration Number" x-model="searchResultRegNo" required class="w-full p-4 rounded-xl text-black bg-white" />
                                        </div>
                                        <button type="submit" class="w-full bg-[#F1400C] hover:bg-orange-700 transition py-4 rounded-xl font-bold">Search Certificate</button>
                                    </form>
                                </div>
                                <!-- RIGHT SIDE RESULT -->
                                <div :class="searchStudentResult ? 'w-full p-4 md:p-10' : 'p-10 flex items-center justify-center'">
                                    <div x-show="searchStudentResult === null" class="text-center">
                                        <img src="{{ asset('logo/logo.jpeg') }}" alt="Search Result" class="w-32 mx-auto mb-2 rounded-full" />
                                        <h3 class="text-2xl font-bold text-gray-700">Certificate Preview</h3>
                                        <p class="text-gray-500 mt-2">Search your Certificate to view details.</p>
                                    </div>
                                    <div x-show="searchStudentResult === false" style="display: none;" class="bg-red-50 border-red-300 rounded-2xl p-8 text-center w-full">
                                        <h3 class="text-2xl font-bold text-red-600">No Result Found</h3>
                                        <p class="mt-3 text-gray-600">Please check your Name and Registration Number.</p>
                                    </div>
                                    <div x-show="searchStudentResult" style="display: none;" class="w-full overflow-x-auto overflow-y-hidden pb-4">
                                        <div id="certificate-print" class="relative mx-auto overflow-hidden rounded-2xl shadow-2xl border border-yellow-200 shrink-0" style="width: 210mm; min-width: 210mm; height: 297mm; padding: 15mm; box-sizing: border-box; overflow: hidden; background: linear-gradient(135deg, #ffffff 0%, #fefce8 50%, #fef3c7 100%)">
                                            <!-- Decorative corner elements -->
                                            <div class="absolute top-0 left-0 w-24 h-24 border-t-4 border-l-4 border-yellow-500 rounded-tl-2xl"></div>
                                            <div class="absolute top-0 right-0 w-24 h-24 border-t-4 border-r-4 border-yellow-500 rounded-tr-2xl"></div>
                                            <div class="absolute bottom-0 left-0 w-24 h-24 border-b-4 border-l-4 border-yellow-500 rounded-bl-2xl"></div>
                                            <div class="absolute bottom-0 right-0 w-24 h-24 border-b-4 border-r-4 border-yellow-500 rounded-br-2xl"></div>
                                            <!-- Golden border frame -->
                                            <div class="absolute inset-3 border-2 border-yellow-300/60 rounded-xl pointer-events-none"></div>
                                            <!-- Certificate content -->
                                            <div class="relative z-10 px-6 py-6 text-center">
                                                <div class="flex items-center gap-4 mb-8">
                                                    <div class="flex-1 h-0.5 bg-gradient-to-r from-transparent via-yellow-400 to-transparent"></div>
                                                    <div class="w-3 h-3 bg-yellow-500 rotate-45"></div>
                                                    <div class="flex-1 h-0.5 bg-gradient-to-r from-transparent via-yellow-400 to-transparent"></div>
                                                </div>
                                                <div class="relative inline-block mb-4">
                                                    <div class="relative w-20 h-20 md:w-24 md:h-24 mx-auto rounded-full border-2 border-yellow-400 p-1.5 shadow-md">
                                                        <div class="w-full h-full rounded-full overflow-hidden bg-white flex items-center justify-center">
                                                            <img src="{{ asset('logo/logo.jpeg') }}" alt="Logo" class="w-full h-full object-contain" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="text-2xl md:text-3xl font-bold text-amber-900 tracking-wider uppercase"><span class="text-[#340C6F]">YOUTH</span> <span class="text-[#F1400C]">REVOLUTIONARY</span></h1>
                                                <p class="text-2xl md:text-3xl font-bold text-amber-900 tracking-wider uppercase text-center">"NASRIGANJ"</p>
                                                <p class="text-amber-700/80 mt-1 text-sm md:text-base font-medium italic">"Excellence in Education & Competitive Achievement"</p>
                                                <div class="flex items-center justify-center gap-3 mt-5">
                                                    <span class="w-16 h-px bg-amber-300"></span><span class="text-amber-400 text-xl">✦</span><span class="w-16 h-px bg-amber-300"></span>
                                                </div>
                                                <div class="text-center mt-6">
                                                    <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-800 tracking-wide">Certificate</h2>
                                                    <p class="text-lg md:text-xl font-serif italic text-amber-600 mt-1">Of Achievement</p>
                                                </div>
                                                <div class="text-center mt-6">
                                                    <p class="text-gray-400 uppercase font-semibold">SEASON - 4</p>
                                                    <p class="text-lg md:text-xl text-gray-500 font-light">This Certificate is Proudly Presented To</p>
                                                    <div class="relative inline-block mt-3">
                                                        <h2 class="text-3xl md:text-4xl font-bold text-amber-900 tracking-wide" x-text="searchStudentResult?.name"></h2>
                                                        <div class="absolute -bottom-1 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-amber-400 to-transparent rounded-full"></div>
                                                    </div>
                                                    <p class="mt-6 text-base md:text-lg leading-relaxed text-gray-600 max-w-2xl mx-auto">
                                                        In recognition of outstanding performance in <span class="font-bold text-amber-700" x-text="searchStudentResult?.category"></span>, securing <span class="font-bold text-emerald-600">Rank #<span x-text="searchStudentResult?.rank"></span></span> with an excellent score of <span class="font-bold text-rose-500" x-text="searchStudentResult?.score"></span>. Your dedication, hard work, and commitment to excellence have brought pride and distinction to the institution.
                                                    </p>
                                                </div>
                                                <div class="flex justify-center mt-6">
                                                    <div class="relative">
                                                        <div class="relative p-1 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 shadow-lg">
                                                            <div class="w-28 h-28 md:w-32 md:h-32 rounded-full overflow-hidden border-4 border-white">
                                                                <img :src="searchStudentResult ? '{{ asset('') }}' + searchStudentResult.image : ''" class="w-full h-full object-cover" />
                                                            </div>
                                                        </div>
                                                        <span class="absolute -top-1 -right-1 text-amber-400 text-lg">⭐</span>
                                                        <span class="absolute -bottom-1 -left-1 text-amber-400 text-lg">⭐</span>
                                                    </div>
                                                </div>
                                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 40px; text-align: left;">
                                                    <div style="background: #FEF3C7; padding: 16px; border-radius: 8px; border: 1px solid #FCD34D;"><strong>Registration No :</strong> <span x-text="searchStudentResult?.regNo"></span></div>
                                                    <div style="background: #FEF3C7; padding: 16px; border-radius: 8px; border: 1px solid #FCD34D;"><strong>Class Group :</strong> <span x-text="searchStudentResult?.classGroup"></span></div>
                                                    <div style="background: #FEF3C7; padding: 16px; border-radius: 8px; border: 1px solid #FCD34D;"><strong>Certificate ID :</strong> CERT-<span x-text="searchStudentResult?.regNo"></span></div>
                                                    <div style="background: #FEF3C7; padding: 16px; border-radius: 8px; border: 1px solid #FCD34D;"><strong>Date :</strong> {{ date('F j, Y') }}</div>
                                                </div>
                                                <div class="flex justify-between mt-10 gap-6">
                                                    <div class="text-center flex-1"><div class="w-36 md:w-44 border-b-2 border-amber-400 mx-auto"></div><p class="mt-2 font-semibold text-gray-700 text-sm">Chairman</p></div>
                                                    <div class="text-center flex-1"><div class="w-36 md:w-44 border-b-2 border-amber-400 mx-auto"></div><p class="mt-2 font-semibold text-gray-700 text-sm">Secretary</p></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-center gap-3">
                                            <button type="button" @click="searchStudentResult = null; searchResultName = ''; searchResultRegNo = ''" class="max-w-xs w-full sm:w-auto mx-auto mt-4 text-center bg-white text-amber-700 border border-amber-300 py-1 px-2 rounded-xl font-semibold text-lg transition shadow-sm">Search Again</button>
                                            <button type="button" @click="downloadPdf('certificate-print', searchStudentResult.regNo + '.pdf')" class="max-w-xs w-full sm:w-auto mx-auto mt-2 text-center bg-gradient-to-r from-amber-600 to-amber-700 text-white py-2 px-3 rounded-xl font-semibold text-lg transition shadow-lg">Download Certificate PDF</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Table -->
            <div x-data="{ show: false }" x-intersect.once="show = true" x-show="show" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-white rounded-3xl shadow-md overflow-hidden my-8 sm:my-10 text-left">
                    <div class="bg-[#028CD4] p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <h2 class="text-2xl font-bold text-white">Competition Results</h2>
                        <div class="relative w-full md:w-80">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="Search by Reg. No" x-model="searchTerm" class="w-full bg-white rounded-xl pl-10 pr-4 py-3 outline-none border border-transparent focus:border-blue-300 text-gray-700" />
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100 text-gray-700">
                                    <th class="p-4 text-left">Reg No</th>
                                    <th class="p-4 text-left">Student</th>
                                    <th class="p-4 text-left">Competition</th>
                                    <th class="p-4 text-center">Score</th>
                                    <th class="p-4 text-center">Rank</th>
                                    <th class="p-4 text-center">Marksheets</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(student, index) in filteredData" :key="student.id">
                                    <tr :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'" class="border-b border-gray-300 hover:bg-blue-50 transition">
                                        <td class="p-4 font-medium" x-text="student.regNo"></td>
                                        <td class="p-4">
                                            <div class="flex items-center gap-3">
                                                <img :src="'{{ asset('') }}' + student.image" class="w-12 h-12 rounded-full object-cover border" />
                                                <span class="font-semibold" x-text="student.name"></span>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm" x-text="student.category"></span>
                                        </td>
                                        <td class="p-4 text-center font-bold text-green-600" x-text="student.score"></td>
                                        <td class="p-4 text-center">
                                            <span :class="student.rank === 1 ? 'bg-yellow-500' : (student.rank === 2 ? 'bg-gray-500' : (student.rank === 3 ? 'bg-orange-500' : 'bg-[#028CD4]'))" class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-white text-sm">
                                                <i class="fa-solid fa-trophy"></i> #<span x-text="student.rank"></span>
                                            </span>
                                        </td>
                                        <td class="p-4 text-center">
                                            <button @click="triggerHtmlDownload(student)" class="inline-flex items-center gap-2 bg-[#F1400C] hover:bg-orange-700 text-white px-4 py-2 rounded-xl transition">
                                                <i class="fa-solid fa-download"></i> PDF
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                                <tr x-show="filteredData.length === 0">
                                    <td colspan="6" class="text-center py-10 text-gray-500">No Results Found</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>
    </div>
</x-app-layout>
