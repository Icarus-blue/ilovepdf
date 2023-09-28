<!DOCTYPE html>
<html>

<head>
    <title>Excel File Upload</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid mt-5">

        <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Excel to PDF Convert</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Split PDF</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Merge PDF</a>
            </li>
        </ul>

        <div class="tab-content mt-3" id="myTabContent">

            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                <div class="progress mt-5" style="margin-bottom:70px">
                    <div class="progress-bar" id="progressbar_first" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
                <h1>Convert Excel to PDF</h1>
                <form action="upload.php" id="excelFile" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="excelFile" class="form-label">Select Excel File</label>
                        <input type="file" class="form-control" id="excelFile" name="excelFile">
                    </div>
                    <button type="button" id="upload_first" class="btn btn-primary">Upload</button>
                    <button type="button" id="download_first" style="display:none" class="btn btn-primary">Download PDF</button>
                </form>
                <div style="display:none" id="previewcontainer_first">
                    <div class="row d-flex align-items-center justify-content-center">
                        <div id="previewContainer" style='background-color:#F6F6F8;height:220px;width:150px' class="d-flex align-items-center justify-content-center">
                            <div class="flex-fill">
                                <img src="./assets/excel.png" class="img-fluid" style="margin-left:13px;margin-top:10px">
                                <p style="text-align: center;" id="filename"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                <div class="progress mt-5" style="margin-bottom:70px">
                    <div class="progress-bar" id="progressbar_second" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
                <h1>Split PDF</h1>
                <form action="upload.php" id="pdfFile" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="pdfFile" class="form-label">Select PDF File</label>
                        <input type="file" class="form-control" id="pdfFile" name="pdfFile">
                    </div>
                    <button type="button" id="upload_second" class="btn btn-primary">Upload</button>
                    <button type="button" id="download_second" style="display:none" class="btn btn-primary">Download PDF</button>
                </form>
                <div style="display:none" id="previewcontainer_second">
                    <div class="row d-flex align-items-center justify-content-center">
                        <div id="previewContainer" style='background-color:#F6F6F8;height:220px;width:150px' class="d-flex align-items-center justify-content-center">
                            <div class="flex-fill">
                                <img src="./assets/excel.png" class="img-fluid" style="margin-left:13px;margin-top:10px">
                                <p style="text-align: center;" id="filename"></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                <div class="progress mt-5" style="margin-bottom:70px">
                    <div class="progress-bar" id="progressbar_third" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
                <h1>Merge PDF</h1>
                <form action="upload.php" id="pdfFile_merge" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="pdfFile_merge" class="form-label">Select PDF File</label>
                        <input type="file" class="form-control" id="pdfFile_merge" name="pdfFile_merge">
                    </div>
                    <button type="button" id="upload_third" class="btn btn-primary">Upload PDF</button>
                    <button type="button" id="download_third" style="display:none" class="btn btn-primary">Download PDF</button>
                </form>
                
                <div style="display:none" id="previewcontainer_third">
                    <div class="row d-flex align-items-center justify-content-center">
                        <div id="previewContainer" style='background-color:#F6F6F8;height:220px;width:150px' class="d-flex align-items-center justify-content-center">
                            <div class="flex-fill">
                                <img src="./assets/excel.png" class="img-fluid" style="margin-left:13px;margin-top:10px">
                                <p style="text-align: center;" id="filename"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
</body>
<script>
    // upload button group
    const uploadbtn_first = document.getElementById('upload_first');
    const uploadbtn_second = document.getElementById('upload_second');
    const uploadbtn_third = document.getElementById('upload_third');
    //

    // download button group
    const downloadbtn_first = document.getElementById('download_first');
    const downloadbtn_second = document.getElementById('download_second');
    const downloadbtn_third = document.getElementById('download_third');
    //

    const spilitbtn = document.getElementById('spilit');
    const mergebtn = document.getElementById('merge');
    const downloadbtn = document.getElementById('download_first');
    const filename = document.getElementById('filename')
    const preveiwcontainer = document.getElementById('previewcontainer_first')
    const progressBar = (elem, time) => {
        var progressBar = document.getElementById(elem);
        var percent = 0;
        var increment = 1;
        var intervalTime = time / 100;

        var interval = setInterval(function() {
            percent += increment;
            progressBar.style.width = percent + '%';
            progressBar.innerHTML = percent.toFixed(2) + '%';

            if (percent >= 100) {
                clearInterval(interval);
            }
        }, intervalTime);
    }

    uploadbtn_first.addEventListener('click', () => {
        Swal.fire({
            icon: 'info',
            title: 'Are you sure to upload this excel file?',
            text: 'This will be converted to pdf format!',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                progressBar("progressbar_first", 3000)
                setTimeout(() => {
                    uploadbtn.style.display = "none"
                    downloadbtn.style.display = "inline"
                    preveiwcontainer.style.display = "block"
                    var progressBar = document.getElementById('progressbar_first');
                    progressBar.style.width = '0%';
                    progressBar.innerHTML = '';
                }, 4000)

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // User clicked the "Cancel" button
                Swal.fire(
                    'Cancelled',
                    'The delete operation was cancelled.',
                    'info'
                );
            }
        });
    })
    downloadbtn.addEventListener('click', () => {
        var xhr = new XMLHttpRequest();
        Swal.fire({
            icon: 'info',
            title: 'Are you sure to download this excel file?',
            text: 'This will be download  pdf format!',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'upload.php');
                var form = document.getElementById('excelFile');
                var formData = new FormData(form);
                formData.append('flag', 0);
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        progressBar(7500)
                    }
                };

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            async function Processing() {
                                await Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Successfully converted',
                                    timer: 2000,
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                });
                                uploadbtn.style.display = "none"
                                downloadbtn.style.display = "none"
                                preveiwcontainer.style.display = "none"
                                spilitbtn.style.display = "inline"

                            }
                            Processing().catch(error => console.log("An error occurred", error))
                        } else {
                            console.error('AJAX request failed with status:', xhr.status);
                        }
                    }
                };
                xhr.send(formData);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // User clicked the "Cancel" button
                Swal.fire(
                    'Cancelled',
                    'The delete operation was cancelled.',
                    'info'
                );
            }
        });
    })
    spilitbtn.addEventListener('click', () => {
        Swal.fire({
            icon: 'info',
            title: 'Are you sure to spilit this pdf file?',
            text: 'This will be spilited!',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'upload.php');
                var formData = new FormData();
                formData.append('flag', 1);

                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        progressBar(5500)
                    }
                };

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Successfully spilited',
                                timer: 2000,
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            });
                        } else {
                            console.error('AJAX request failed with status:', xhr.status);
                        }
                    }
                };
                xhr.send(formData);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // User clicked the "Cancel" button
                Swal.fire(
                    'Cancelled',
                    'The delete operation was cancelled.',
                    'info'
                );
            }
        });
    })
    mergebtn.addEventListener('click', () => {
        Swal.fire({
            icon: 'success',
            title: 'Are you sure to merge  pdf files?',
            text: 'This will be merged!',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'upload.php');
                var formData = new FormData();
                formData.append('flag', 2);
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        progressBar(6000)
                    }
                };

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Successfully merged',
                                timer: 2000,
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            });
                        } else {
                            console.error('AJAX request failed with status:', xhr.status);
                        }
                    }
                };
                xhr.send(formData);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // User clicked the "Cancel" button
                Swal.fire(
                    'Cancelled',
                    'The delete operation was cancelled.',
                    'info'
                );
            }
        });
    })
</script>

</html>