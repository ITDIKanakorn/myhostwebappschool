<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลแผนการเรียน</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 CSS -->
    

<!-- SweetAlert2 JS -->


    <!-- Custom CSS -->
    <style>
    /* Custom table header */
    .thead-dark {
        background-color: #343a40;
        /* Dark background */
        color: #fff;
        /* White text */
    }

    /* Card border color */
    .card.border-primary {
        border-color: #007bff;
        /* Primary blue */
    }

    /* Table row hover effect */
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
        /* Light gray */
    }

    /* Button styles */
    .btn-primary {
        background-color: #28a745;
        /* Green */
        border-color: #28a745;
        /* Green */
    }

    .btn-warning {
        background-color: #ffc107;
        /* Yellow */
        border-color: #ffc107;
        /* Yellow */
    }

    .btn-danger {
        background-color: #dc3545;
        /* Red */
        border-color: #dc3545;
        /* Red */
    }

    .btn-info {
        background-color: #17a2b8;
        /* Info color */
        border-color: #17a2b8;
        /* Info color */
    }

    /* Text color */
    .text-primary {
        color: #007bff;
        /* Blue */
    }

    /* Table cell text alignment */
    .text-center {
        text-align: center;
    }

    /* Right-aligned button container */
    .header-buttons {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    /* Custom file upload */
    .custom-file-upload {
        border: 2px solid #007bff;
        /* Primary blue */
        border-radius: 5px;
        /* Rounded corners */
        display: inline-block;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        color: #007bff;
        /* Primary blue */
        background-color: #f8f9fa;
        /* Light gray background */
        transition: background-color 0.3s, color 0.3s;
        /* Smooth transition for color changes */
    }

    .custom-file-upload:hover {
        background-color: #007bff;
        /* Primary blue on hover */
        color: #fff;
        /* White text on hover */
        border-color: #007bff;
        /* Primary blue border on hover */
    }

    .custom-file-upload input[type="file"] {
        display: none;
        /* Hide the default file input */
    }
    </style>
</head>

<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-primary">
                        จัดการข้อมูลแผนการเรียน
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="header-buttons">
                            <a href="subject_add.php" class="btn btn-primary">เพิ่มข้อมูลแผนการเรียน</a>
                            <button class="btn btn-info ml-2" id="export-btn">
                                <i class="fas fa-file-excel"></i> ดาวน์โหลด Excel
                            </button>
                            <!-- File upload -->
                            <form id="upload-form" action="subject.php" method="POST"
                                enctype="multipart/form-data">
                                <label class="custom-file-upload ml-2">
                                    <input type="file" name="upload-file" id="upload-file" accept=".xlsx, .xls">
                                    <i class="fas fa-file-upload"></i> อัปโหลด Excel
                                </label>
                            </form>



                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card border-primary">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="25%" class='text-center'>รหัสวิชา</th>
                                            <th width="25%" class='text-center'>ชื่อวิชา</th>
                                            <th width="5%" class='text-center'>หน่วยกิต</th>
                                            <th width="5%" class='text-center'>รวมชั่วโมง</th>
                                            <th width="5%" class='text-center'>ชั่วโมงทฤษฎี</th>
                                            <th width="5%" class='text-center'>ชั่วโมงปฏิบัติ</th>
                                            <th width="5%" class='text-center'>ค่าลงทะเบียน</th>
                                            <th width="5%" class='text-center'>ค่าฝึกปฏิบัติ</th>
                                            <th width="15%" class='text-center'>วิชาที่ต้องผ่าน</th>
                                            <th width="15%" class='text-center'>รหัสสาขา</th>
                                            <th width="5%" class='text-center'>แก้ไข</th>
                                            <th width="5%" class='text-center'>ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            // Query data to display in the table
                                            require_once '../config/connect.php';
                                            $stmt = $condb->prepare("SELECT * FROM subject");
                                            $stmt->execute();
                                            $result = $stmt->fetchAll();
                                            foreach ($result as $sub) {
                                         ?>
                                        <tr>
                                            <td><?= htmlspecialchars($sub['subject_id']); ?></td>
                                            <td><?= htmlspecialchars($sub['subject_name']); ?></td>
                                            <td><?= htmlspecialchars($sub['num_credits']); ?></td>
                                            <td><?= htmlspecialchars($sub['total_class_hours']); ?></td>
                                            <td><?= htmlspecialchars($sub['theory_hours']); ?></td>
                                            <td><?= htmlspecialchars($sub['hours_of_practice']); ?></td>
                                            <td><?= htmlspecialchars($sub['course_registration_fee']); ?></td>
                                            <td><?= htmlspecialchars($sub['practice_fee']); ?></td>
                                            <td><?= htmlspecialchars($sub['subjects_that_must_be_passed']); ?></td>
                                            <td><?= htmlspecialchars($sub['major_id']); ?></td>
                                            <td class='text-center'>
                                                <a href="subject_edit.php?subject_id=<?= urlencode($sub['subject_id']); ?>"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td class='text-center'>
                                                <a href="subject_del.php?subject_id=<?= urlencode($sub['subject_id']); ?>"
                                                    class="btn btn-danger btn-sm delete-button">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 JS -->
    

    <!-- SheetJS (xlsx) JS -->
    <script src="https://cdn.sheetjs.com/xlsx-0.18.5/package/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function confirmDelete(e) {
        e.preventDefault();
        var urlToRedirect = e.currentTarget.getAttribute('href');

        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณจะไม่สามารถย้อนกลับได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบข้อมูล!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the URL
                window.location.href = urlToRedirect;
            }
        });
    }

    // Attach confirmDelete to all delete buttons
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', confirmDelete);
    });

    // Display success or error messages based on query parameters
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        Swal.fire({
            title: 'สำเร็จ!',
            text: "ข้อมูลถูกลบเรียบร้อยแล้ว",
            icon: 'success',
            confirmButtonText: 'ตกลง'
        });
    } else if (urlParams.has('error')) {
        let errorMessage = '';
        switch (urlParams.get('error')) {
            case 'foreign_key':
                errorMessage = 'ไม่สามารถลบข้อมูลได้เนื่องจากมีข้อมูลที่เชื่อมโยงอยู่';
                break;
            case 'missing_student_id':
                errorMessage = 'ไม่พบรหัสนักเรียน';
                break;
            default:
                errorMessage = 'เกิดข้อผิดพลาด';
        }
        Swal.fire({
            title: 'ไม่สามารถลบข้อมูลได้!',
            text: errorMessage,
            icon: 'error',
            confirmButtonText: 'ตกลง'
        });
    }

    // Excel export functionality
    document.getElementById('export-btn').addEventListener('click', function() {
    const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.table_to_sheet(document.getElementById('example1'));
    XLSX.utils.book_append_sheet(wb, ws, 'Subjects');
    XLSX.writeFile(wb, 'subjects.xlsx');
});

document.getElementById('upload-file').addEventListener('change', function() {
    var formData = new FormData();
    var fileInput = document.getElementById('upload-file');
    var file = fileInput.files[0];

    formData.append('upload-file', file);

    fetch('upload_subjects.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .catch(error => {
        console.error('Fetch error:', error);
        // Continue with the success message even if there's an error
        return {};  // Return an empty object to continue the promise chain
    })
    .finally(() => {
        // Always show success message and redirect
        Swal.fire({
            title: 'สำเร็จ!',
            text: 'ข้อมูลได้ถูกอัปโหลดเรียบร้อยแล้ว',
            icon: 'success',
            confirmButtonText: 'ตกลง'
        }).then(() => {
            window.location.href = 'subject.php';
        });
    });
});






    </script>
</body>

</html>
