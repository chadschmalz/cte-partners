@component('mail::message')
# Priority Registration Expired

Hello {{$student->fname." ".$student->lname}},

Your online internship application is being processed. Due to the following reason, we couldn’t assign your first semester of choice:<br />
<br />
 **You need to take a related CTE pathway course to qualify for this capstone internship course.<br />

Please contact either of us listed below to discuss your options for taking this qualifying course, and we can explain more.  <br />

Thank you for applying to the CTE Washk12 Internship Program! <br />
<br /><br />
Sincerely,<br />
Mike Hassler, Workbased Learning Coordinator<br />
mike.hassler@washk12.org<br />
435-817-5714<br /><br />


@endcomponent
