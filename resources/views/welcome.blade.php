<!DOCTYPE html>
<html lang="en">
<head>
	<title>Turing Machine</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--==============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
<!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</head>
<body> 
    <div class="limiter">            
		<div class="container-login100">             
            @if(session()->has('success'))
                @if(session()->get('success'))
                    <script type="text/javascript">
                    var texto = '{{ session()->get("success") }}';
                        Swal.fire(
                            'Good job!',
                            texto,
                            'success',
                        )
                    </script>
                @endif
            @endif
            @if(session()->has('error'))
                @if(session()->get('error')) 
                    <script type="text/javascript">
                        Swal.fire(
                            'Good job!',
                            'You clicked the button!',
                            'error',
                        )
                    </script>
                @endif
            @endif               
			<div class="wrap-login100">                 
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../images/turingMachine.gif" alt="IMG">
                </div>                                
                <form class="login100-form validate-form" method="post" action="{{url('/turing')}}">      
                    @csrf          
					<span class="login100-form-title">
						Turing Machine
					</span>                        
                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" name="estados" placeholder="Estados (Ex.: Q0, Q1, Q2..)">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" name="finais" placeholder="Estado Final (Ex.: Q2)">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" name="entrada" placeholder="Entrada (Ex.: 1100111)">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="conteudo">
                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="text" name="transicao1" placeholder="Transições (Q0,1(Q1,0,R))">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-cogs" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    <div>
						<button type="button" id="add_inputs" class="btn btn-success pull-right">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
						</button>
                    </div>                    
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Rodar
						</button>
                    </div>                
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->	
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--===============================================================================================-->
    <script src="../vendor/tilt/tilt.jquery.min.js"></script>  
<!--===============================================================================================-->      
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
    <script src="js/main.js"></script>
<!--===============================================================================================-->
    <script>
        $(document).ready(function() {
            var max_fields = 10; 
            var wrapper = $(".conteudo"); 
            var add_button = $("#add_inputs"); 

            var x = 1; 
            $(add_button).click(function(e) { 
                e.preventDefault();
                var length = wrapper.find("input:text").length;
                console.log(length);

                if (x < max_fields) { 
                x++; 

                $(wrapper).append('<div class="input-group-text">'+
                                '<div class="wrap-input100 validate-input">'+
                                '<input class="input100" type="text" name="transicao'+ (length+1) + '" placeholder="Transições (Q0,1(Q1,0,R))">'+
                                '<span class="focus-input100"></span>'+
                                '<span class="symbol-input100">'+
                                '<i class="fa fa-cogs" aria-hidden="true"></i></span></div>'+
                                '<a href="#" class="remove_field" style="margin-left: 10%; color: red;">Remover</a></div>'); 
                }
            });
            $(wrapper).on("click", ".remove_field", function(e) { 
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        });
    </script>   
</body>
</html>