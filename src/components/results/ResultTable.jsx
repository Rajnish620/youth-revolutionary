import { useMemo, useState } from "react";
import { Download, Trophy, Search, } from "lucide-react";

const ResultTable = ({ data = [] }) => {
  const [searchTerm, setSearchTerm] = useState("");

  const filteredData = useMemo(() => {
    return data.filter((student) =>
      student.regNo?.toLowerCase().includes(searchTerm.toLowerCase())
    );
  }, [data, searchTerm]);

  const handleCertificateAction = async (student, action = "download") => {
    const html = `
    <div style="
      font-family: Arial, sans-serif;
      background: #eef4f8;
      padding: 24px;
      color: #1f2937;
    ">
      <div style="
        max-width: 900px;
        margin: auto;
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid #dbe4ea;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
      ">

        <!-- Top Header -->
        <div style="
          background: linear-gradient(135deg, #028CD4, #026aa1);
          color: white;
          padding: 24px 30px;
        ">
          <div style="
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
          ">
           <div>
            <div style="display:flex; align-items:center; gap:10px;">
  <img
    src="/logo/logo.jpeg"
    alt="logo"
    style="
      height: 40px;
      width: 40px;
      border-radius: 50%;
      object-fit: contain;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    "
  />

  <h1 style="
    margin-bottom:20px;
    font-size: 28px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 6px;
  ">
    <span style="color:#340C6F;">YOUTH</span>
    <span style="color:#F1400C;">REVOLUTIONARY</span>
  </h1>
</div>

             
        </div>

            <div style="
              
              padding: 5px 8px;
              border-radius: 8px;
              min-width: 180px;
            ">
              <p style="margin: 0; font-size: 12px; opacity: 0.9;">Registration No</p>
              <p style="margin: 3px 0 0; font-size: 15px; font-weight: 700;">
                ${student.regNo || "-"}
              </p>
            </div>
          </div>
        </div>

        <!-- Body -->
        <div style="padding: 28px;">

          <!-- Student Info -->
          <div style="
            display: flex;
            gap: 20px;
            align-items: center;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
            background: #f9fbfc;
            margin-bottom: 24px;
          ">
            <div>
              <img
                src="${student.image || ""}"
                alt="${student.name || "Student"}"
                style="
                  width: 90px;
                  height: 90px;
                  object-fit: cover;
                  border-radius: 50%;
                  border: 3px solid #dbeafe;
                  background: #fff;
                "
              />
            </div>

            <div style="flex: 1;">
              <h2 style="
                margin: 0;
                font-size: 26px;
                color: #111827;
                font-weight: 700;
              ">
                ${student.name || "-"}
              </h2>

              <div style="
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
                margin-top: 14px;
              ">
                <div>
                  <p style="margin: 0; font-size: 12px; color: #6b7280;">Competition</p>
                  <p style="margin: 4px 0 0; font-size: 16px; font-weight: 600;">
                    ${student.category || "-"}
                  </p>
                </div>

                <div>
                  <p style="margin: 0; font-size: 12px; color: #6b7280;">Rank</p>
                  <p style="margin: 4px 0 0; font-size: 16px; font-weight: 600;">
                    #${student.rank ?? "-"}
                  </p>
                </div>

                <div>
                  <p style="margin: 0; font-size: 12px; color: #6b7280;">Result Status</p>
                  <p style="
                    margin: 4px 0 0;
                    font-size: 16px;
                    font-weight: 700;
                    color: #16a34a;
                  ">
                    Qualified
                  </p>
                </div>

                <div>
                  <p style="margin: 0; font-size: 12px; color: #6b7280;">Total Score</p>
                  <p style="
                    margin: 4px 0 0;
                    font-size: 18px;
                    font-weight: 700;
                    color: #028CD4;
                  ">
                    ${student.score ?? "-"}
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Marksheet Table -->
          <div style="
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 24px;
          ">
            <div style="
              background: #f3f4f6;
              padding: 14px 18px;
              border-bottom: 1px solid #e5e7eb;
            ">
              <h3 style="margin: 0; font-size: 18px; color: #111827;">
                Result Summary
              </h3>
            </div>

            <table style="
              width: 100%;
              border-collapse: collapse;
              font-size: 15px;
            ">
              <thead>
                <tr style="background: #fafafa;">
                  <th style="padding: 14px; text-align: left; border-bottom: 1px solid #e5e7eb;">Particular</th>
                  <th style="padding: 14px; text-align: left; border-bottom: 1px solid #e5e7eb;">Details</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="padding: 14px; border-none: 1px solid #f0f0f0; font-weight: 600;">Student Name</td>
                  <td style="padding: 14px; border-none: 1px solid #f0f0f0;">${student.name || "-"}</td>
                </tr>
                <tr>
                  <td style="padding: 14px; border-none: 1px solid #f0f0f0; font-weight: 600;">Registration Number</td>
                  <td style="padding: 14px; border-none: 1px solid #f0f0f0;">${student.regNo || "-"}</td>
                </tr>
                <tr>
                  <td style="padding: 14px; border-none: 1px solid #f0f0f0; font-weight: 600;">Competition</td>
                  <td style="padding: 14px; border-none: 1px solid #f0f0f0;">${student.category || "-"}</td>
                </tr>
                <tr>
                  <td style="padding: 14px; border-none: 1px solid #f0f0f0; font-weight: 600;">Score Obtained</td>
                  <td style="padding: 14px; border-none: 1px solid #f0f0f0;">${student.score ?? "-"}</td>
                </tr>
                <tr>
                  <td style="padding: 14px; border-none: 1px solid #f0f0f0; font-weight: 600;">Rank</td>
                  <td style="padding: 14px; border-none: 1px solid #f0f0f0;">#${student.rank ?? "-"}</td>
                </tr>
                <tr>
                  <td style="padding: 14px; font-weight: 600;">Final Result</td>
                  <td style="padding: 14px; color: #16a34a; font-weight: 700;">Qualified</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Highlight Cards -->
          <div style="
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 26px;
          ">
            <div style="
              background: #eff6ff;
              border: 1px solid #bfdbfe;
              border-radius: 14px;
              padding: 18px;
            ">
              <p style="margin: 0; font-size: 12px; color: #6b7280;">Obtained Score</p>
              <p style="margin: 8px 0 0; font-size: 24px; font-weight: 700; color: #028CD4;">
                ${student.score ?? "-"}
              </p>
            </div>

            <div style="
              background: #fff7ed;
              border: 1px solid #fed7aa;
              border-radius: 14px;
              padding: 18px;
            ">
              <p style="margin: 0; font-size: 12px; color: #6b7280;">Position / Rank</p>
              <p style="margin: 8px 0 0; font-size: 24px; font-weight: 700; color: #ea580c;">
                #${student.rank ?? "-"}
              </p>
            </div>

            <div style="
              background: #ecfdf5;
              border: 1px solid #bbf7d0;
              border-radius: 14px;
              padding: 18px;
            ">
              <p style="margin: 0; font-size: 12px; color: #6b7280;">Result Status</p>
              <p style="margin: 8px 0 0; font-size: 24px; font-weight: 700; color: #16a34a;">
                Qualified
              </p>
            </div>
          </div>

          <!-- Remarks -->
          <div style="
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-left: 5px solid #028CD4;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 34px;
          ">
            <p style="margin: 0; font-size: 13px; color: #6b7280;">Remarks</p>
            <p style="margin: 8px 0 0; line-height: 1.7; font-size: 15px;">
              ${student.name || "The student"} has successfully completed the competition/examination in
              <strong> ${student.category || "-"} </strong>
              and secured <strong>Rank #${student.rank ?? "-"}</strong> with a score of
              <strong> ${student.score ?? "-"} </strong>.
            </p>
          </div>

          <!-- Footer Signatures -->
          <div style="
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-top: 30px;
          ">
            <div style="text-align: center; width: 220px;">
              <div style="border-top: 1px solid #111827; margin-bottom: 8px;"></div>
              <p style="margin: 0; font-weight: 600;">Coordinator</p>
            </div>

            <div style="text-align: center; width: 220px;">
              <div style="border-top: 1px solid #111827; margin-bottom: 8px;"></div>
              <p style="margin: 0; font-weight: 600;">Authority</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  `;



    const mod = await import("../../utils/downloadHtmlAsPdf");
    const fn = mod.downloadHtmlAsPdf;

    if (fn) {
      await fn(html, `${student.regNo || "certificate"}.pdf`, action);
    }
  };

  return (
    <div className="bg-white rounded-3xl shadow-md overflow-hidden m-10">
      {/* Header + Search */}
      <div className="bg-[#028CD4] p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h2 className="text-2xl font-bold text-white">Competition Results</h2>

        <div className="relative w-full md:w-80">
          <Search
            size={18}
            className="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
          />
          <input
            type="text"
            placeholder="Search by Reg. No"
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            className="w-full bg-white rounded-xl pl-10 pr-4 py-3 outline-none border border-transparent focus:border-blue-300 text-gray-700"
          />
        </div>
      </div>

      <div className="overflow-x-auto">
        <table className="w-full">
          <thead>
            <tr className="bg-gray-100 text-gray-700">
              <th className="p-4 text-left">Reg No</th>
              <th className="p-4 text-left">Student</th>
              <th className="p-4 text-left">Competition</th>
              <th className="p-4 text-center">Score</th>
              <th className="p-4 text-center">Rank</th>
              <th className="p-4 text-center">Marksheets</th>
            </tr>
          </thead>

          <tbody>
            {filteredData.length > 0 ? (
              filteredData.map((student, index) => (
                <tr
                  key={student.id}
                  className={`
                    border-b border-gray-300 hover:bg-blue-50 transition
                    ${index % 2 === 0 ? "bg-white" : "bg-gray-50"}
                  `}
                >
                  <td className="p-4 font-medium">{student.regNo}</td>

                  <td className="p-4">
                    <div className="flex items-center gap-3">
                      <img
                        src={student.image}
                        alt={student.name}
                        className="w-12 h-12 rounded-full object-cover border"
                      />
                      <span className="font-semibold">{student.name}</span>
                    </div>
                  </td>

                  <td className="p-4">
                    <span className="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                      {student.category}
                    </span>
                  </td>

                  <td className="p-4 text-center font-bold text-green-600">
                    {student.score}
                  </td>

                  <td className="p-4 text-center">
                    <span
                      className={`
                        inline-flex items-center gap-1 px-3 py-1 rounded-full text-white text-sm
                        ${student.rank === 1
                          ? "bg-yellow-500"
                          : student.rank === 2
                            ? "bg-gray-500"
                            : student.rank === 3
                              ? "bg-orange-500"
                              : "bg-[#028CD4]"
                        }
                      `}
                    >
                      <Trophy size={14} />
                      #{student.rank}
                    </span>
                  </td>

                  <td className="p-4 text-center">
                    <div className="flex items-center justify-center gap-2 flex-wrap">

                      <button
                        onClick={() => handleCertificateAction(student, "download")}
                        className="inline-flex items-center gap-2 bg-[#F1400C] hover:bg-orange-700 text-white px-4 py-2 rounded-xl transition"
                      >
                        <Download size={16} />
                        PDF
                      </button>
                    </div>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="6" className="text-center py-10 text-gray-500">
                  No Results Found
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default ResultTable;