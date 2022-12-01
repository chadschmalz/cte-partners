@component('mail::message')
# Application Letter - Prerequisite Required

Hello {{$student->fname." ".$student->lname}},

Your online internship application is being processed. Due to the following reason, we couldn’t assign your first semester of choice.<br /><br />

You need to take a CTE pathway course to qualify for this capstone internship course.

<br />

Contact your career coach to discuss your options for taking this internship course. <br /><br />

<div style="text-align:center">
<u>Please contact us with the following</u>:<br /><br />
washk12internships@washk12.org | (435)673-3553 x5162<br /><br />
<strong>Jessica Hogan | WBL Office Secretary</strong><br /><br />

</div>

<br />
Thank you for applying to the CTE Washk12 Internship Program!




Sincerely,<br />
Washk12Internship Team
@endcomponent
