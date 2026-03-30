$(document).ready(function () {

    loadDbSize();
    loadServerInfo();
    loadLastBackup();
    loadBackupCount();
    loadServerTime();
    loadStorage();
    loadLogSize();

    setInterval(loadServerTime, 1000);

});



// DB SIZE
function loadDbSize() {

    $.get("../php/settings/get_db_size.php", function (data) {

        $("#dbSize").text(data);

    });

}


// SERVER INFO
function loadServerInfo() {

    $.get("../php/settings/get_server_info.php", function (data) {

        let res = JSON.parse(data);

        $("#phpVersion").text(res.php);
        $("#dbName").text(res.db);
        
        if(res.mysql){
            $("#mysqlVersion").text(res.mysql);
        }

    });

}


// LAST BACKUP
function loadLastBackup() {

    $.get("../php/settings/get_last_backup.php", function (data) {

        $("#lastBackup").text(data);

    });

}


// BACKUP COUNT
function loadBackupCount(){

    $.get("../php/settings/get_backup_count.php", function(data){

        $("#backupCount").text(data);

    });

}


// SERVER TIME
function loadServerTime(){

    $.get("../php/settings/get_server_time.php", function(data){

        $("#serverTime").text(data);

    });

}


// STORAGE
function loadStorage(){

    $.get("../php/settings/get_storage.php", function(data){

        $("#storageUsed").text(data);

    });

}



// BUTTONS

$("#backupBtn").click(function () {

    Swal.fire({
        title: "Create backup?",
        icon: "question",
        showCancelButton: true
    }).then((result) => {

        if (result.isConfirmed) {

            Swal.fire({
                title: "Creating backup...",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(function(){

                $.post("../php/settings/backup_db.php", function () {

                    Swal.fire({
                        icon: "success",
                        title: "Backup created",
                        timer: 1200,
                        showConfirmButton: false
                    });

                    loadBackupCount();
                    loadBackupSize();
                    loadLastBackup();
                    loadDbSize();

                });

            }, 300);

        }

    });

});


$("#clearLogs").click(function(){

    Swal.fire({
        title: "Clear logs?",
        icon: "warning",
        showCancelButton: true
    }).then((result) => {

        if (result.isConfirmed) {

            Swal.fire({
                title: "Clearing logs...",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(function(){

                $.post("../php/settings/clear_logs.php", function(){

                    Swal.fire({
                        icon: "success",
                        title: "Logs cleared",
                        timer: 1200,
                        showConfirmButton: false
                    });
                
                    loadLogSize();
                
                });

            }, 300);

        }

    });

});



function loadLogSize() {

    $.get("../php/settings/get_logs_size.php", function (data) {

        $("#logSize").text(data);

    });

}


$("#clearBackup").click(function(){

    Swal.fire({
        title: "Delete backups?",
        icon: "warning",
        showCancelButton: true
    }).then((result) => {

        if (result.isConfirmed) {

            Swal.fire({
                title: "Deleting backups...",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(function(){

                $.post("../php/settings/clear_backup.php", function(){

                    Swal.fire({
                        icon: "success",
                        title: "Backups deleted",
                        timer: 1200,
                        showConfirmButton: false
                    });

                    // ✅ UPDATE UI
                    loadBackupCount();
                    loadBackupSize();
                    loadLastBackup();   // ← ADD THIS
                    loadDbSize();       // optional

                });

            }, 300);

        }

    });

});


loadBackupSize();

function loadBackupSize(){

    $.get("../php/settings/get_backup_size.php", function(data){

        $("#backupSize").text(data);       
        $("#backupSizeText").text(data);   

    });

}