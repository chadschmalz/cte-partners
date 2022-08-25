@component('mail::message')
# Application Letter - Prerequisite Required

Hello {{$student->fname." ".$student->lname}},

Your online internship application is being processed. Due to the following reason, we couldn’t assign your first semester of choice.<br /><br />

You need to take a CTE pathway course to qualify for this capstone internship course.

<br />

Contact your career coach to discuss your options for taking this internship course. <br /><br />

<div style="text-align:center">
<u>Internship Contacts</u>:<br /><br />
<strong> Sophia Ford | Career Coach</strong><br />
sophia.ford@washk12.org | (435) 656-1076<br />
Schools: Desert Hills, Dixie,  & Snow Canyon<br /><br />
<strong>Mike Hassler - Work-Based Learning Coordinator</strong><br />
mike.hassler@washk12.org | 435-817-5714<br />
School: Crimson Cliffs, Pineview, Hurricane, Water Canyon, Millcreek, & Enterprise<br /><br />
</div>

<br />
Thank you for applying to the CTE Washk12 Internship Program!




Sincerely,<br />
Washk12Internship Team
@endcomponent
