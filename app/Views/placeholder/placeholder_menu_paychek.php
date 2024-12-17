<script>
    $(document).ready(function() {
        $('#btnModal').click(function() {
            var fileInput = document.getElementById('formFile');
            Swal.fire({
                title: 'Processing...',
                html: '<div class="loading-spinner"></div>',
                allowOutsideClick: false,
                showConfirmButton: false,
            });
            // Check if button text is "Insert new file"
            if ($('#btnModal').text() === '<?= getTranslation('text-insert-new-file') ?>') {
                // Reset the form and show the file input
                // Show confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to insert a new file?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, insert it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the desired page
                        window.location.href = '<?= base_url('/paycheck') ?>';
                    }
                });
                return;
                Swal.fire({
                    title: 'Processing...',
                    html: '<div class="loading-spinner"></div>',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
            }

            if (!fileInput.files || !fileInput.files[0]) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select a file!',
                });
            } else {
                var fileName = fileInput.files[0].name;
                var fileExtension = fileName.split('.').pop().toLowerCase();
                if (fileExtension !== 'xls' && fileExtension !== 'xlsx') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Incorrect file format!',
                        text: 'Please select a valid Excel file (.xls or .xlsx).',
                    });
                    return;
                }
                var formData = new FormData();
                formData.append('formFile', fileInput.files[0]);
                $.ajax({
                    url: '<?= base_url('/paycheck/read') ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    // Old success function
                    // success: function(response) {
                    //     var responseData = JSON.parse(response); // Parsing response dari JSON

                    //     // Populate the year dropdown
                    //     var yearDropdown = $('#filterYear');
                    //     yearDropdown.empty(); // Clear existing options
                    //     yearDropdown.append('<option value="">All</option>'); // Add default option

                    //     if (responseData.years && responseData.years.length > 0) {
                    //         responseData.years.forEach(function(year) {
                    //             yearDropdown.append('<option value="' + year + '">' + year + '</option>');
                    //         });
                    //     }

                    //     // Memfilter data dari responseData.data
                    //     var filteredData = responseData.data.filter(function(row) {
                    //         // Convert object values to an array and check if any value is not null
                    //         return Object.values(row).some(function(cell) {
                    //             return cell !== null;
                    //         });
                    //     });

                    //     if (filteredData.length === 0) {
                    //         console.log('All rows contain null values');
                    //         return;
                    //     }
                    //     var columns = filteredData.shift();
                    //     var convertedData = filteredData.map(function(row) {
                    //         var rowData = {};
                    //         for (var i = 0; i < columns.length; i++) {
                    //             if (columns[i] === 'Periode') {
                    //                 row[i] = excelSerialToDate(row[i]);
                    //                 if (row[i] === 'Invalid Date') {
                    //                     row[i] = null;
                    //                 }
                    //             }
                    //             // Check if Employee ID is missing
                    //             if (columns[i] === 'EmployeeId' && !row[i]) {
                    //                 row[i] = 'No Employee ID'; // Add text when missing
                    //             }
                    //             rowData[columns[i]] = row[i];
                    //         }
                    //         return rowData;
                    //     });
                    //     console.log(responseData.data);

                    //     $('#example').DataTable({
                    //         responsive: true,
                    //         lengthChange: false,
                    //         autoWidth: false,
                    //         data: convertedData, // This should contain the full data but we'll only show specific columns
                    //         destroy: true,
                    //         columns: [{
                    //                 data: 'EmployeeId' // Column for Employee ID
                    //             }, {
                    //                 data: 'Periode' // Column for Periode
                    //             },
                    //             {
                    //                 data: 'Nama Lengkap' // Column for Nama
                    //             },
                    //             {
                    //                 data: 'total_transfer', // Column for total_transfer with custom rendering
                    //                 render: function(data, type, row) {
                    //                     return formatRupiah(data); // Ensure salary is displayed in currency format
                    //                 }
                    //             }, {
                    //                 data: 'Bank' // Column for Bank
                    //             }, {
                    //                 data: 'AccountNo' // Column for Account No.
                    //             }, {
                    //                 data: 'Send Salary Slip' // Column for Salary.
                    //             }, {
                    //                 data: 'Email' // Column for Salary.
                    //             }
                    //         ]
                    //     });

                    //     //Success notification
                    //     Swal.fire({
                    //         icon: 'success',
                    //         title: 'Success!!',
                    //         text: 'Record has been updated!',
                    //         allowOutsideClick: false,
                    //     });

                    //     // Event listener for year dropdown
                    //     $('#filterYear').on('change', function() {
                    //         var selectedYear = $(this).val(); // Get the selected year

                    //         // Get the DataTable instance
                    //         var table = $('#example').DataTable();

                    //         // If no year is selected, reset the filter
                    //         if (selectedYear === "") {
                    //             table.column(1).search('').draw(); // Reset filter
                    //         } else {
                    //             // Use a regular expression to match the year in the "YYYY-MM-DD" format
                    //             var regex = '^' + selectedYear + '-\\d{2}-\\d{2}$'; // Match rows starting with "YYYY"
                    //             table.column(1).search(regex, true, false).draw(); // Apply the filter
                    //         }
                    //     });

                    //     // Event listener for periode dropdown
                    //     $('#filterPeriode').on('change', function() {
                    //         var selectedMonth = $(this).val();

                    //         // Filter the DataTable by month
                    //         var table = $('#example').DataTable();

                    //         // If no month is selected, reset the filter
                    //         if (selectedMonth === "") {
                    //             table.column(1).search('').draw(); // Reset filter
                    //         } else {
                    //             // Use a regular expression to match the month in "YYYY-MM-DD" format
                    //             var regex = '^\\d{4}-' + selectedMonth + '-\\d{2}$'; // Match "2024-01-31" format
                    //             table.column(1).search(regex, true, false).draw(); // Apply the filter
                    //         }
                    //     });

                    //     // Event listener for eligible dropdown
                    //     $('#filterPaycek').on('change', function() {
                    //         var selectedOption = $(this).val();

                    //         // Filter the DataTable by month
                    //         var table = $('#example').DataTable();

                    //         // If no month is selected, reset the filter
                    //         if (selectedOption === "") {
                    //             table.column(6).search('').draw(); // Reset filter
                    //         } else {
                    //             // Use a regular expression to match the month in "YYYY-MM-DD" format
                    //             table.column(6).search('^' + selectedOption + '$', true, false).draw(); // Apply the filter
                    //         }
                    //     });

                    //     $('#btnModal').text('<?= getTranslation('text-insert-new-file') ?>');
                    //     $('#formFilelbl').hide();
                    //     $('#fileNameDisplay').text(` - ${fileName}`);
                    //     $('#formFile').hide();
                    //     $('#dataTable').show();
                    // },
                    // New success function v1
                    // success: function(response) {
                    //     var responseData = JSON.parse(response);
                    //     console.log('Raw Response:', responseData);
                    //     var periodeDropdown = $('#filterPeriode');
                    //     periodeDropdown.empty().append('<option value="">Select Periode</option>');
                    //     responseData.periodes.forEach(function(periode) {
                    //         periodeDropdown.append('<option value="' + periode + '">' + periode + '</option>');
                    //     });

                    //     var filteredData = responseData.data.filter(function(row) {
                    //         return Object.values(row).some(function(cell) {
                    //             return cell !== null;
                    //         });
                    //     });

                    //     if (filteredData.length === 0) {
                    //         console.log('All rows contain null values');
                    //         return;
                    //     }

                    //     var columns = filteredData.shift();
                    //     var convertedData = filteredData.map(function(row) {
                    //         var rowData = {};
                    //         for (var i = 0; i < columns.length; i++) {
                    //             if (columns[i] === 'Periode') {
                    //                 row[i] = excelSerialToDate(row[i]);
                    //                 if (row[i] === 'Invalid Date') {
                    //                     row[i] = null;
                    //                 }
                    //             }
                    //             if (columns[i] === 'EmployeeId' && !row[i]) {
                    //                 row[i] = 'No Employee ID';
                    //             }
                    //             rowData[columns[i]] = row[i];
                    //         }
                    //         return rowData;
                    //     });

                    //     var table = $('#example').DataTable({
                    //         responsive: true,
                    //         lengthChange: false,
                    //         autoWidth: false,
                    //         data: convertedData,
                    //         destroy: true,
                    //         columns: [{
                    //                 data: 'EmployeeId'
                    //             },
                    //             {
                    //                 data: 'Periode'
                    //             },
                    //             {
                    //                 data: 'Nama Lengkap'
                    //             },
                    //             {
                    //                 data: 'total_transfer',
                    //                 render: function(data) {
                    //                     return formatRupiah(data);
                    //                 }
                    //             },
                    //             {
                    //                 data: 'Bank'
                    //             },
                    //             {
                    //                 data: 'AccountNo'
                    //             },
                    //             {
                    //                 data: 'Send Salary Slip'
                    //             },
                    //             {
                    //                 data: 'Email'
                    //             }
                    //         ]
                    //     });

                    //     // Success notification
                    //     Swal.fire({
                    //         icon: 'success',
                    //         title: 'Success!!',
                    //         text: 'Record has been updated!',
                    //         allowOutsideClick: false,
                    //     });

                    //     $('#example').hide();

                    //     // Event listener for year and period filters
                    //     $('#filterYear, #filterPeriode').on('change', function() {
                    //         const selectedYear = $('#filterYear').val();
                    //         const selectedPeriod = $('#filterPeriode').val();

                    //         // Build the search regex
                    //         let regex = '';
                    //         if (selectedYear && selectedPeriod) {
                    //             regex = `^${selectedYear}-${selectedPeriod}-\\d{2}$`; // YYYY-MM-DD format
                    //         } else if (selectedYear) {
                    //             regex = `^${selectedYear}-\\d{2}-\\d{2}$`; // Any month and day
                    //         } else if (selectedPeriod) {
                    //             regex = `^\\d{4}-${selectedPeriod}-\\d{2}$`; // Any year with specific month
                    //         }

                    //         // Apply the filter if regex is not empty
                    //         if (regex) {
                    //             table.column(1).search(regex, true, false).draw();
                    //             $('#example').show();
                    //         } else {
                    //             table.column(1).search('').draw(); // Clear the filter if no value is selected
                    //             $('#example').hide();
                    //         }
                    //     });

                    //     // Event listener for eligible dropdown
                    //     $('#filterPaycek').on('change', function() {
                    //         var selectedOption = $(this).val();

                    //         // Filter the DataTable by month
                    //         var table = $('#example').DataTable();

                    //         // If no month is selected, reset the filter
                    //         if (selectedOption === "") {
                    //             table.column(6).search('').draw(); // Reset filter
                    //         } else {
                    //             // Use a regular expression to match the month in "YYYY-MM-DD" format
                    //             table.column(6).search('^' + selectedOption + '$', true, false).draw(); // Apply the filter
                    //         }
                    //     });

                    //     $('#btnModal').text('<?= getTranslation('text-insert-new-file') ?>');
                    //     $('#formFilelbl').hide();
                    //     $('#fileNameDisplay').text(` - ${fileName}`);
                    //     $('#formFile').hide();
                    //     $('#dataTable').show();
                    // },
                    // New success function v2
                    success: function(response) {
                        var responseData = JSON.parse(response); // Parsing response dari JSON
                        console.log('response data', responseData);
                        // Populate the year dropdown
                        var periodeDropdown = $('#filterPeriode');
                        periodeDropdown.empty().append('<option value="">Select Periode</option>');
                        responseData.periodes.forEach(function(periode) {
                            periodeDropdown.append('<option value="' + periode + '">' + periode + '</option>');
                        });

                        // Memfilter data dari responseData.data
                        var filteredData = responseData.data.filter(function(row) {
                            // Convert object values to an array and check if any value is not null
                            return Object.values(row).some(function(cell) {
                                return cell !== null;
                            });
                        });

                        if (filteredData.length === 0) {
                            console.log('All rows contain null values');
                            return;
                        }
                        var columns = filteredData.shift();
                        console.log('columns', columns);
                        var convertedData = filteredData.map(function(row) {
                            var rowData = {};
                            for (var i = 0; i < columns.length; i++) {
                                if (columns[i] === 'Periode') {
                                    row[i] = excelSerialToDate(row[i]);
                                    if (row[i] === 'Invalid Date') {
                                        row[i] = null;
                                    }
                                }
                                // Check if Employee ID is missing
                                if (columns[i] === 'EmployeeId' && !row[i]) {
                                    row[i] = 'No Employee ID'; // Add text when missing
                                }
                                rowData[columns[i]] = row[i];
                            }
                            return rowData;
                        });

                        // Convert Periode column to match dropdown format (DD-MMM-YY) for filtering
                        convertedData.forEach(row => {
                            if (row.Periode) {
                                row.Periode = formatDateToMatchDropdown(row.Periode); // Custom function
                            }
                        });

                        var table = $('#example').DataTable({
                            responsive: true,
                            lengthChange: false,
                            autoWidth: false,
                            data: convertedData, // This should contain the full data but we'll only show specific columns
                            destroy: true,
                            columns: [{
                                    data: 'EmployeeId' // Column for Employee ID
                                }, {
                                    data: 'Periode' // Column for Periode
                                },
                                {
                                    data: 'Nama Lengkap' // Column for Nama
                                },
                                {
                                    data: 'total_transfer', // Column for total_transfer with custom rendering
                                    render: function(data, type, row) {
                                        return formatRupiah(data); // Ensure salary is displayed in currency format
                                    }
                                }, {
                                    data: 'Bank' // Column for Bank
                                }, {
                                    data: 'AccountNo' // Column for Account No.
                                }, {
                                    data: 'Send Salary Slip' // Column for Salary.
                                }, {
                                    data: 'Email' // Column for Salary.
                                }
                            ]
                        });

                        //Success notification
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!!',
                            text: 'Record has been updated!',
                            allowOutsideClick: false,
                        });


                        // Event listener for year and period filters
                        $('#filterPeriode').on('change', function() {
                            const selectedPeriod = $('#filterPeriode').val();

                            if (selectedPeriod) {
                                table.column(1).search(`^${selectedPeriod}$`, true, false).draw(); // Exact match
                                $('#example').show();
                            } else {
                                table.column(1).search('').draw(); // Clear filter
                                $('#example').hide();
                            }
                        });


                        console.log('Converted Data Periode:', convertedData.map(row => row.Periode));


                        // Event listener for eligible dropdown
                        $('#filterPaycek').on('change', function() {
                            var selectedOption = $(this).val();

                            // Filter the DataTable by month
                            var table = $('#example').DataTable();

                            // If no month is selected, reset the filter
                            if (selectedOption === "") {
                                table.column(6).search('').draw(); // Reset filter
                            } else {
                                // Use a regular expression to match the month in "YYYY-MM-DD" format
                                table.column(6).search('^' + selectedOption + '$', true, false).draw(); // Apply the filter
                            }
                        });

                        $('#btnModal').text('<?= getTranslation('text-insert-new-file') ?>');
                        $('#formFilelbl').hide();
                        $('#fileNameDisplay').text(` - ${fileName}`);
                        $('#formFile').hide();
                        $('#dataTable').show();
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX request failed!');
                        console.log('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Incorrect format!',
                            text: 'Please insert the correct file format',
                        });
                    }
                });
            }
        });
    });
</script>