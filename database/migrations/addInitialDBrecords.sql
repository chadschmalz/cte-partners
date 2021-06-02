



SET @NameOfFirstUser ='Sample User Name';
SET  @EmailOfFirstUser ='sample.user@washk12.org';

SET @Semester_desc ='Semester 1 2021-22';
SET  @Semester_schoolYear ='2021-22';
Set @semester_enddt = '2021-12-31';


use internshipdev;

-- Add First User
INSERT INTO users
( name, email,password, created_at, updated_at)
VALUES
( @NameOfFirstUser, @EmailOfFirstUser,NULL, CURDATE(), CURDATE());

INSERT INTO user_permissions
( email, permission_level, location_id, job_function_id)
VALUES
( @EmailOfFirstUser, 'superuser', 100, 0);

-- Add first semester
INSERT INTO semesters
( semester_desc, school_year, semester_enddt, status, created_at, updated_at, deleted_at)
VALUES
( @Semester_desc, @Semester_schoolYear, @semester_enddt, 'active', CURDATE(), NULL, NULL);
