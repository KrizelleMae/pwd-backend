<?php 
function body($title, $position) {
    $body = '
    <body
    style="
        display: flex;
        justify-content: center;
        margin-top: 10px;
        font-family: Arial Light;
    "
    >
    <div
        style="
        width: 380px;
        height: 380px;
        "
    >
        <p
        class="text-top"
        style="
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 30px;
        "
        >                 
       Good Day!
        </p>

        <div class="body" style="font-size: 14px; font-weight: light; text-align:justify;">
        <p>
            Congratulations, your application for <b>'.$title.' ('.$position.')</b> has been reviewed and accepted!
        </p>              

        <p>
            You will be contacted by a company representation. Kindly prepare the needed requirements for the Job. Thank you!
        </p>
        <p>
            If you have questions, you may contact us at
            pwdjobszc@gmail.com
        </p>
        </div>

    
    </div>
    </body>';

    return $body;
 
}

?>
