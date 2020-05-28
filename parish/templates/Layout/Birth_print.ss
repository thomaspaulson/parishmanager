                    
      <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
          <h3 class="text-center">$MetaTitle</h3>  
          
                    
            <% with $BirthCertificate %>
                <div class="grid-x grid-padding-x">
                    <div class="large-3 cell">							
                            <p class="text-left">Reg No $RegNO / $Year</p>
                    </div>
                    <div class="large-9 cell">
                        <p class="text-right">Date: $Now.Format('d-m-Y')</p>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-4 cell">  
                        <p class="text-left">Name</p>
                    </div>
                    <div class="large-8 cell">
                        <p class="text-left">: $Name</p>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-4 cell">  
                        <p class="text-left">FathersName</p>
                    </div>
                    <div class="large-8 cell">
                        <p class="text-left">: $FathersName</p>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-4 cell">  
                        <p class="text-left">MothersName</p>
                    </div>
                    <div class="large-8 cell">
                        <p class="text-left">: $MothersName</p>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-4 cell">  
                        <p class="text-left">DOB, Location</p>
                    </div>
                    <div class="large-8 cell">
                        <p class="text-left">: $DOB.Format('d-m-Y'), $Location</p>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-4 cell">  
                        <p class="text-left">Baptised on, Baptised at</p>
                    </div>
                    <div class="large-8 cell">
                        <p class="text-left">: $BaptisedDate.Format('d-m-Y'), $BaptisedAt</p>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-4 cell">  
                        <p class="text-left">Baptised by</p>
                    </div>
                    <div class="large-8 cell">
                        <p class="text-left">: $Priest</p>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-4 cell">  
                        <p class="text-left">GodFather</p>
                    </div>
                    <div class="large-8 cell">
                        <p class="text-left">: $GodFather</p>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-4 cell">  
                        <p class="text-left">GodFatherParish</p>
                    </div>
                    <div class="large-8 cell">
                        <p class="text-left">: $GodFatherParish</p>
                    </div>
                </div>


                <div class="grid-x grid-padding-x">
                    <div class="large-4 cell">  
                        <p class="text-left">GodMother</p>
                    </div>
                    <div class="large-8 cell">
                        <p class="text-left">: $GodMother</p>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-4 cell">  
                        <p class="text-left">GodMotherParish</p>
                    </div>
                    <div class="large-8 cell">
                        <p class="text-left">: $GodMotherParish</p>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-4 cell"> 																																		
                    </div>									
                    <div class="large-4 cell"> 																																		
                    </div>																		
                </div>                         
                
            <% end_with %>		<%-- with $BirthCertificate --%>                    
            <hr>
        </div>
      </div>
                
