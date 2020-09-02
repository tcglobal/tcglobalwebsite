<script src="/form/custom_validation.js"></script>
<form action="" method="post">
            <div class="group">
               <input type="text"  class="w-100" novalidate name="name" id="name" required>
               <span class="highlight"></span>
               <span class="bar"></span>
               <label>Your name</label>
            </div>
            <div class="group">
               <input type="text"  class="w-100" novalidate name="email" id="email" required>
               <span class="highlight"></span>
               <span class="bar"></span>
               <label>Your e-mail</label>
            </div>
            <div class="group">
               <input type="text"  class="w-100" novalidate name="mobile" id="mobile" required>
               <span class="highlight"></span>
               <span class="bar"></span>
               <label>Your mobile number</label>
            </div>
            <div class="group">
               <div class="position-absolute alignright"><img src="/wp-content/themes/tcglobal/images/dropdown.png" alt="" width="10"></div>
               <select class="w-100" id="service" name="service" required>
                <option></option>
                <option>demo</option>
                <option>demo_1</option>
                <option>demo_2</option>
              </select>
               <label>Choose Service</label>
            </div>
            <div class="group m-b-20">
               <textarea class="w-100" placeholder="Your message" name="message" id="message" rows="4"></textarea>
            </div>
            <div class=" termslink m-b-30">
               <div class="customcheckbox">
                  <input type="checkbox" id="html">
                  <label for="html"><span>Accept TC Globals <a href="">Terms&Conditions</a> and <a href="">Privacy Policy</a></span></label>
               </div>
            </div>
            <div class="group ">
               <button type="button" class="redbtn w-100 d-flex align-items-center justify-content-center text-uppercase text-decoration-none submitform">SEND</button>
            </div>
         </form>