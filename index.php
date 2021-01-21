<?php session_start();/*нужно для глобальный переменных сесии*/?>
<!DOCTYPE html>
<html>
	<head>
		<title>Лабораторная работа №1 /Речкалов Михаил</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<style>
            table {
                width: 700px; 
                border: 2px solid #000; 
                color: #08f;
            }
            td {
                padding: 3px; 
                text-align: center; 
                border-bottom: 1px solid #000; 
            }
            .header {
		        font-family: fantasy; 
                font-size: 24px;
		        color: #336; 
            }
            .custom-checked {
                background: #ff8; 
                border: 2px solid #000;
            }
            div.form-input > div{

                margin: 0 0 30px 50px;
            }
            div.radio-container  span{
                margin-right: 20px;
               
            }
            h3{
                margin-left: 100px;
                color: #722;
            }
            #submit-button {
                text-decoration: none;
                display: inline-block;
                width: 140px;
                height: 45px;
                line-height: 45px;
                border-radius: 15px;
                margin: 10px 20px;
                font-family: 'Montserrat', sans-serif;
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
                text-align: center;

                color: #524f4e;
                background: white;
            }
            #submit-button:hover {
                background: #2EE59D;
                box-shadow: 0 15px 20px rgba(46, 229, 157, .4);
                color: white;
                transform: translateY(-5px);
            }
        </style>
	</head>
	<body>
		
		<?php include "header.html" ?>
		<form action="index.php" method="get" onsubmit="return formcheck();">
    		<div class="form-input">
    		   
    		    <div>
                    <p>
    		            Координата X:
                        <input type="button" name="coordX-button" value="-3">
                        <input type="button" name="coordX-button" value="-2">
                        <input type="button" name="coordX-button" value="-1">
                        <input type="button" name="coordX-button" value="0" class="custom-checked" >
                        <input type="button" name="coordX-button" value="1" >
                        <input type="button" name="coordX-button" value="2" >
                        <input type="button" name="coordX-button" value="3" >
                        <input type="button" name="coordX-button" value="4" >
                        <input type="button" name="coordX-button" value="5" >
                        <!--костыль для отправки на сервер. Это не для заполнения юзером, я не нашёл способа отправлять данные с кнопок напрямую-->
                        <input type="text" name=coordX id="coordX" style="display: none;" value="0" readonly>
    		        </p>
                </div>
    		    <div>
    		        Координата Y:
    		        <input type="text" class="number" name="coordY" id="coordY" placeholder=" от -3 до 3"> 
    		    </div>
                <div class="radio-container">
                    <!--span тут используется только чтобы всё было в строку. Можно было div + float: left;-->
                    <span>Параметр R:</span>
                    <span><input type="radio" name="paramR" value="1" checked>1</span>
                    <span><input type="radio" name="paramR" value="1.5">1,5</span>
                    <span><input type="radio" name="paramR" value="2">2</span>
                    <span><input type="radio" name="paramR" value="2.5">2,5</span>
                    <span><input type="radio" name="paramR" value="3">3</span>
                        
    		    </div>
    		    <div>
                    <p color=#f00 id="wrong-input-message" hidden="true">Вы ввели данные некорректно</p>
                    <p><input type="submit" id="submit-button"></p>
                </div> 
    		</div>
		</form>
		
		<div>
		    <center>
		        <img src="areas.png">
		    </center>
		</div>
		<?php
		include "check.php"; //определение попадания точки в область и формирование таблички
		?>
		<script>
            //назначаем батонам для ввода X обработчики
            var inputs = document.getElementsByName("coordX-button");
            for(var i = 0; i < inputs.length; i++) 
                inputs[i].onclick = ButtonXfunc;
            document.getElementById("coordY").onkeyup = checkY;
            //проверка поля Y и подсветка правильности ввода. Наверное это не стоит делать по id в js а может быть делать классами и css, но и так работает хорошо
            function checkY(event){
                var objY=document.getElementById("coordY");
                    if(objY.value.match(new RegExp("^((-[1-3])|(-[0-2][\.,][0-9]{1,})|([0-3])|([0-2](\.)[0-9]{1,}))$"))){
                        objY.style.backgroundColor="#9C9";
                        return true;
                    }
                    objY.style.backgroundColor="#f33" ;
                    return false; 
            }
			//проверка правильности формы. X и R считается всегда определённым, так что проверка Y
			function formcheck() {
                    if(checkY())
                        return true;		
                    document.getElementById("wrong-input-message").hidden=false;
                    return false;
    		}
			
		
		
            //делаем из батонов радио
            function ButtonXfunc(e) {
                this.classList.add("custom-checked");
                document.getElementById("coordX").value=this.value;
              	for(var i = 0; i < inputs.length; i++){
                    if(inputs[i]!=this)
                        inputs[i].classList.remove("custom-checked");    
                }        		
            }
		</script>
	</body>
</html>