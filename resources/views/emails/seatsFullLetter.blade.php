@component('mail::message')
# Application Deferral Letter

Hello {{$student->fname." ".$student->lname}},

Your online internship application is being processed. Due to high demand in your pathway, we couldn’t assign your first semester of choice.<br /><br />

In the event a spot becomes available, in your semester of choice, students that have completed the training will get priority placement. <br /><br />

<div style="text-align:center">
<strong>Requirement for priority placement</strong>
<br />
</div>
<br />
<ul type="1">
  <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSdDkG6S6TcK21MdkkAX-_9eom649npAYaepJj611DY4eEuNnw/viewform">Click Here to register</a> for training <strong>within 7 days</strong>, or we cannot place you on the priority list. </li>
</ul>
<br />

<div style="text-align:center">
<u>Internship Contacts</u>:<br /><br />
<strong> Sophia Ford | Career Coach</strong><br />
sophia.ford@washk12.org | (435) 656-1076<br />
Schools: Desert Hills, Dixie,  & Snow Canyon<br /><br />
<strong>Mike Hassler - Work-Based Learning Coordinator</strong><br />
mike.hassler@washk12.org | 435-817-5714<br />
School: Crimson Cliffs, Pineview, Hurricane, Water Canyon, Millcreek, & Enterprise<br /><br />
</div>

You will be receiving more communication as we get closer. Work hard, keep your G.P.A. high, and continue to be engaged in your classes. If you have any questions please feel free to contact the appropriate contact listed above.<br />
<br />
Thank you for applying to the CTE Washk12 Internship Program!




Sincerely,<br />
Washk12Internship Team
@endcomponent
