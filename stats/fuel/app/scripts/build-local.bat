cd C:\xampp\htdocs\MDSOLVesselStats\src
del C:\xampp\htdocs\MDSOLVesselStats\src\fuel\app\config\development\migrations.php
php oil refine recreate_db
php oil refine install
php oil refine migrate
php oil refine install_core_db
php oil refine install_test_data
echo 'Success'
pause