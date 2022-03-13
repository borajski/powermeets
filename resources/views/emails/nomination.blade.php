<h3>Web application</h3>
<p>
@php
$ispis = explode(",",$feedback);
foreach ($ispis as $element)
{
echo $element."<br>";
}

@endphp
</p>
@php 
$quill = new \DBlackborough\Quill\Render($nominacija->meet->gensetts->em_poruka, 'HTML');
$result = $quill->render();             
echo $result;                    
@endphp
