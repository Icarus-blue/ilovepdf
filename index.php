<!DOCTYPE html>
<html>

<head>
    <title>Excel File Upload</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid mt-5" style="padding-top:10px">
        <div class="progress mt-5" style="margin-bottom:70px">
            <div class="progress-bar" id="progressbar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
        <h1>Excel File Upload</h1>
        <form action="upload.php" id="excelFile" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="excelFile" class="form-label">Select Excel File</label>
                <input type="file" class="form-control" id="excelFile" name="excelFile">
            </div>
            <button type="button" id="upload" class="btn btn-primary">Upload</button>
            <button type="button" id="spilit" class="btn btn-primary">Spilit</button>
            <button type="button" id="merge" class="btn btn-primary">merge</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    const uploadbtn = document.getElementById('upload');
    const spilitbtn = document.getElementById('spilit');
    const mergebtn = document.getElementById('merge');

    const progressBar = (time) => {
        var progressBar = document.querySelector('.progress-bar');
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

    uploadbtn.addEventListener('click', () => {
        Swal.fire({
            icon: 'info',
            title: 'Are you sure to upload this excel file?',
            text: 'This will be converted to pdf format!',
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
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Successfully converted',
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