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
                <form action="upload.php" method="POST" id="excelform" enctype="multipart/form-data">
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
                                <p style="text-align: center;" id="Excelfilename"></p>
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
                <form action="upload.php" method="POST" id="splitPDF" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="pdfFile" class="form-label">Select PDF File</label>
                        <input type="file" class="form-control" id="pdfFile" name="pdfFile">
                    </div>
                    <button type="button" id="upload_second" class="btn btn-primary">Upload</button>
                    <button type="button" id="download_second" style="display:none" class="btn btn-primary">Download PDF</button>
                </form>

                <div style="display:none;margin-top:100px" id="previewcontainer_second" class="row">

                </div>
            </div>

            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                <div class="progress mt-5" style="margin-bottom:70px">
                    <div class="progress-bar" id="progressbar_third" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
                <h1>Merge PDF</h1>
                <form action="upload.php" id="pdfFile_merge_form" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="pdfFile_merge" class="form-label">Select PDF File</label>
                        <input type="file" class="form-control" id="pdfFile_merge" name="pdfFile_merge" multiple>
                    </div>
                    <button type="button" id="upload_third" class="btn btn-primary">Upload PDF</button>
                    <button type="button" id="download_third" style="display:none" class="btn btn-primary">Download PDF</button>
                </form>

                <div style="display:none;margin-top:100px" class='row' id="previewcontainer_third">
                    <div class="col-md-4"></div>
                    <div class="col-md-4" style="background-color:#F6F6F8;" id="injecting">

                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.worker.js"></script>
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

    // preview container group
    const preveiwcontainer_first = document.getElementById('previewcontainer_first')
    const preveiwcontainer_second = document.getElementById('previewcontainer_second')
    const preveiwcontainer_third = document.getElementById('previewcontainer_third')
    //
    const selectedImageNumber = [];
 
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
                    uploadbtn_first.style.display = "none"
                    download_first.style.display = "inline"
                    previewcontainer_first.style.display = "block"
                    var progressBar = document.getElementById('progressbar_first');
                    progressBar.style.width = '0%';
                    progressBar.innerHTML = '';
                    const Excelfile = document.getElementById('excelFile').files[0]
                    document.getElementById('Excelfilename').innerHTML = Excelfile.name
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

    uploadbtn_second.addEventListener('click', () => {
        Swal.fire({
            icon: 'info',
            title: 'Are you sure to upload this PDF file to split?',
            text: 'This PDF file will be splitted!',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                var file = document.getElementById('pdfFile').files[0];
                var fileReader = new FileReader();
                fileReader.onload = function() {
                    var typedarray = new Uint8Array(this.result);
                    pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
                        var totalPages = pdf.numPages;
                        var previewcontainer_second = document.getElementById("previewcontainer_second");
                        var imagesPerDiv = 6; // Number of images per div
                        var divCounter = 0; // Counter for tracking div creation
                        for (var pageNumber = 1; pageNumber <= totalPages; pageNumber++) {
                            (function(pageNumber) {
                                pdf.getPage(pageNumber).then(function(page) {
                                    var canvas = document.createElement('canvas');
                                    var context = canvas.getContext('2d');
                                    var viewport = page.getViewport({
                                        scale: 0.5
                                    });

                                    canvas.width = viewport.width;
                                    canvas.height = viewport.height;

                                    page.render({
                                        canvasContext: context,
                                        viewport: viewport
                                    }).promise.then(function() {
                                        var previewDiv;
                                        var previewImg = document.createElement('img');
                                        previewImg.src = canvas.toDataURL();
                                        previewImg.className = 'img-fluid';
                                        previewImg.style.border = '1px solid black';

                                        if (divCounter % imagesPerDiv === 0) {
                                            previewDiv = document.createElement('div');
                                            previewDiv.className = 'col-md-12 mb-12';
                                            previewcontainer_second.appendChild(previewDiv);
                                        } else {
                                            previewDiv = previewcontainer_second.lastElementChild;
                                        }

                                        // Add EventListener to each image
                                        previewImg.addEventListener('click', function() {
                                            console.log(pageNumber);
                                            if (this.classList.contains('check')) {
                                                this.classList.remove('check');
                                                this.style.border = "1px solid black";
                                                var pageIndex = selectedPages.indexOf(pageNumber);
                                                if (pageIndex !== -1) {
                                                    selectedImageNumber.splice(pageIndex, 1);
                                                }
                                            } else {
                                                this.classList.add('check');
                                                this.style.border = "2px solid red";
                                                selectedImageNumber.push(pageNumber);
                                            }
                                            console.log(selectedImageNumber);
                                        });

                                        previewDiv.appendChild(previewImg);
                                        divCounter++;
                                    });
                                });
                            })(pageNumber);
                        }
                    });
                };

                fileReader.readAsArrayBuffer(file);

                progressBar("progressbar_second", 1500)
                setTimeout(() => {
                    uploadbtn_second.style.display = "none"
                    download_second.style.display = "inline"
                    previewcontainer_second.style.display = "flex"
                    var progressBar = document.getElementById('progressbar_second');
                    progressBar.style.width = '0%';
                    progressBar.innerHTML = '';
                }, 2000)

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

    uploadbtn_third.addEventListener('click', () => {
        Swal.fire({
            icon: 'info',
            title: 'Are you sure to upload PDF files to merge?',
            text: 'These PDF files will be merged!',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                var filenames = [];
                var files = document.getElementById('pdfFile_merge').files;
                for (i = 0; i < files.length; i++) {
                    filenames.push(files[i].name)
                }
                var elementstr = "";
                for (i = 0; i < filenames.length; i++) {
                    elementstr += `<div> <img src="./assets/pdf-256.png" class="img-fluid" style="width:85px;height:80px">
                                <p id="filename">${filenames[i]}</p></div>`;
                }
                progressBar("progressbar_third", 3000)
                setTimeout(() => {
                    uploadbtn_third.style.display = "none"
                    downloadbtn_third.style.display = "inline"
                    var progressBar = document.getElementById('progressbar_third');
                    progressBar.style.width = '0%';
                    document.getElementById("previewcontainer_third").style.display = "block";
                    document.getElementById("injecting").innerHTML = elementstr;
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

    downloadbtn_first.addEventListener('click', () => {
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
                var form = document.getElementById('excelform');
                var formData = new FormData(form);
                formData.append('flag', 0);
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        progressBar("progressbar_first", 8500)
                    }
                };

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            async function Processing() {
                                await Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Successfully downloaded',
                                    timer: 2000,
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                });
                                previewcontainer_first.style.display = "none"
                                var progressBar = document.getElementById('progressbar_first');
                                progressBar.style.width = '0%';
                                progressBar.innerHTML = '';
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

    downloadbtn_second.addEventListener('click', () => {
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
                var splitPDF = document.getElementById("splitPDF");
                filename = document.getElementById("pdfFile").files[0].name
                var formData = new FormData(splitPDF);
                formData.append('flag', 1);
                formData.append('fname', filename);
                formData.append('numarr', selectedImageNumber);
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        progressBar('progressbar_second', 7500)
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

    downloadbtn_third.addEventListener('click', () => {
        Swal.fire({
            icon: 'success',
            title: 'Are you sure to merge  pdf files?',
            text: 'This will be merged!',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                var filenames = [];
                var files = document.getElementById('pdfFile_merge').files;
                for (i = 0; i < files.length; i++) {
                    filenames.push(files[i].name)
                }
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'upload.php');
                var formData = new FormData();
                formData.append('flag', 2);
                formData.append('fnamearr', filenames);
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        progressBar('progressbar_third',12000)
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
                            document.getElementById('previewcontainer_third').style.display="none"
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