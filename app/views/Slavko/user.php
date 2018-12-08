   <main role="main" class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<p class="h1">Пользователи</p>
				<hr>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<p class="h3 text-center">Список</p>
				<hr>
				<div class="row">
					<div class="col-sm-3">
						<p class="h5 text-center font-weight-bold">Имя</p>
					</div>
					<div class="col-sm-3">
						<p class="h5 text-center font-weight-bold">email</p>
					</div>
					<div class="col-sm-3">
						<p class="h5 text-center font-weight-bold">логин</p>
					</div>
					<div class="col-sm-3">
						<p class="h5 text-center font-weight-bold">Действие</p>
					</div>
				</div>
				<hr>
                                <?php foreach ($users as $user): ?>
                                    <div class="row">
                                            <div class="col-sm-3">
                                                    <p class="font-weight-normal"><?php echo $user['name'] ?></p>
                                            </div>
                                            <div class="col-sm-3">
                                                    <p class="font-weight-normal"><?php echo $user['email'] ?></p>
                                            </div>
                                            <div class="col-sm-3 text-center">
                                                    <p class="font-weight-normal"><?php echo $user['login'] ?></p>
                                            </div>
                                            <div class="col-sm-3">
                                                    <a class="btn btn-secondary" href="/slavko/user?id=<?php echo $user['id'] ?>" role="button">Удалить</a>
                                            </div>

                                    </div>
                                    <hr>
                                <?php endforeach; ?>
			</div>
			<div class="col-sm-6">
				<p class="h3 text-center">
				   Новый
				</p>
				<hr>
                                <form name="user" method="post" action="/slavko/user">
				  <div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="validationDefault01">Имя</label>
                                          <input type="text" class="form-control" id="validationDefault01" name="name" placeholder="Имя" value="" required>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="validationDefault02">Электронная почта</label>
                                          <input type="email" class="form-control" id="validationDefault02" name="email" placeholder="email" value="" required>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="validationDefaultUsername">Имя для входа (логин)</label>
					  <div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text" id="inputGroupPrepend2">@</span>
						</div>
                                              <input type="text" class="form-control" id="validationDefaultUsername" name="login" placeholder="Логин" aria-describedby="inputGroupPrepend2" required>
					  </div>
					</div>
				  </div>
				  
				  
				  <div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="password">Пароль</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Пароль" aria-describedby="passwordHelpInline" required>
						<small id="passwordHelpInline" class="text-muted">
						  Не менее 6 символов
						</small>
					</div>
					<div class="col-md-3 mb-3">
						<label for="password1">Пароль ещё раз</label>
						<input type="password" class="form-control" id="password1" placeholder="Пароль" aria-describedby="passwordHelpInline" required onblur="checkPassword()">
						<small id="passwordHelpInline" class="text-muted">
						  Должен совпасть
						</small>
					</div>
					<div class="col-md-3 mb-3 text-right">
						<small>
						<p id="checkPass" class="text-left text-danger"></p>
						</small>
					</div>
					<div class="col-md-3 mb-3 text-right">
						<br><br>
						<button class="btn btn-primary" type="submit">Сохранить</button>
					</div>
				  </div>
				</form>	
			</div>
		</div>
		
		<script>
			function checkPassword() {
			    console.log("Проверяю");
				var p1 =  document.getElementById("password").value,
				p2 =  document.getElementById("password1").value,
				info =  document.getElementById("checkPass"),
				txt = "Внимание!!!",
				er = 0;
				
				info.innerHTML = "";

				if(p1.length < 6) {
					txt += " Длина пароля менее 6 символов; ";
					er ++;
				}
				if (p1 != p2) {
					txt += " пароли не совпадают";
					er++;
				} 
				if (er > 0) {
					info.innerHTML = txt;
				}
				
				
			}
		</script>


    </main>