<?php //get_header(); 
/*
Template Name: 404
*/
$html = '<p>HTML-код</p>'
?>
<main>
    <!-- <h2>Ошибка 404 страница не найдена</h2> -->
    <h1>HTML и PHP</h1>
    <p> Дата: <?php echo date('m.d.y'); ?></p>
    <?php
        echo $html;
        function hello($name = 'world') {
            echo 'hello ' . $name;
        }
        hello('Andrey')
    ?>

</main>
<?php //get_footer(); ?>