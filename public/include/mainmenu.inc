        <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
            <a class="navbar-brand" href="#">HMDoll</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav mr-auto">
                <?php foreach ($menu as $menuitem): ?>  
                    <li class="nav-item active">
                      <a class="nav-link <?php if ($menuitem['id'] == 1) {echo ' active';} ?>" href="<?php echo $menuitem['href']; ?>"><?php echo $menuitem['title']; ?><span class="sr-only">(current)</span></a>
                    </li>
                <?php endforeach; ?> 
                
              </ul>
              <form class="form-inline mt-2 mt-md-0">
                              <label for="inputLanguage" class=" text-light">Язык/Language:<span>&nbsp &nbsp;&nbsp;</span> </label>
                              <select class="custom-select mr-sm-2" id="inputLanguage">
                                      <option value="1" selected >Русский</option>
                                      <option value="2">English</option>
                              </select>		 
              </form>
            </div>
          </nav>

