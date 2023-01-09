<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c8 = new AppController();
$c8->GetAllElement();
$c8->GetAllTable_association();
$c8->SetCommantaire();
$arrayAfterFilter8 = [];
foreach($c8->AllElement as $element){
      if($element->GetAspeets_traiter()->GetLibelle() == "Analyse resultats EFM et accompagnent des stagaires"){
        $arrayAfterFilter8[] = $element ;
      }
}
$rowSpanNum8 = count($arrayAfterFilter8) + 1 ;

$validationGroupRows8 = "

    <tr>
        <td rowspan='{$rowSpanNum8}'>Analyse resultats EFM et accompagnent des stagaires</td>
    </tr>
";

foreach($arrayAfterFilter8 as $element){
    $id_user = $_SESSION["info"]["id"] ;
    if($element->GetCommentType()=="select"){
        $otherOption = "";
        if($element->GetComment() != null){
            foreach($element->GetComment() as $message){
                $otherOption .= "
                <option value='{$message->GetId()}'>
                {$message->GetText_commantaire()}
                </option>";
           }
           $validationGroupRows8 .= "
           <tr>
               <td>{$element->GetElement()}</td>
               <td><input type='number'  id_ele = '{$element->GetId()}' value='{$element->GetDonnees()}' /></td>
               <td>
                   <select name='selectComment' id='{$element->GetId()}'>
                   <option value=''>Choisir Un</option>
                           {$otherOption}
                   </select>
                   <button type='button' id='btn-select' id_ele='{$element->GetId()}' id_user='{$id_user}'>Ajouter Un option</button>
               </td>
               </tr>
            " ;
        }else{
            $validationGroupRows8 .= "
           <tr>
               <td>{$element->GetElement()}</td>
               <td><input type='number' id_ele = '{$element->GetId()}' value='{$element->GetDonnees()}' /></td>
               <td>
                   <select name='selectComment' id='{$element->GetId()}'>
                   <option value=''>Choisir Un</option>
                           {$otherOption}
                   </select>
                   <button type='button' id='btn-select' id_ele='{$element->GetId()}' id_user='{$id_user}'>Ajouter Un option</button>
               </td>
               </tr>
            " ;
        }
        
    }else{
        $val = $element->GetComment()==null ?"":$element->GetComment()->GetText_commantaire();
        $validationGroupRows8 .= "
        <tr>
            <td>{$element->GetElement()}</td>
            <td><input type='number' id_ele = '{$element->GetId()}' value='{$element->GetDonnees()}' /></td>
            <td><textarea name='textarea' id='textComment' placeholder='Add Comment:' id_ele = '{$element->GetId()}'  >{$val}</textarea></td>
        </tr>
        " ;
    }
    
    
    
}

echo $validationGroupRows8 ;

?>