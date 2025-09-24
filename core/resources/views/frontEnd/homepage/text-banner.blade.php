<?php
$home_page_id = Helper::GeneralWebmasterSettings("home_content4_section_id");
?>
@if($home_page_id >0)
<?php
$HomePage = Helper::Topic(Helper::GeneralWebmasterSettings("home_content4_section_id"));
$page_form = @$HomePage->form;
?>
@if(!empty($HomePage))
@if(@$HomePage->$details_var !="")
<section class="content-row-no-bg home-welcome">
    <div class="container">
        {!! @$HomePage->$details_var !!}
        @if(!empty($page_form))
        <?php
        $form_url = Helper::sectionURL($page_form->id);
        ?>
        @endif
    </div>
</section>
@endif
@endif
@endif
