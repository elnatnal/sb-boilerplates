helpers do

  # Sends mail using the Pony Gem
  #
  # to           - The address to receive the email
  # subject      - The subject line of the email
  # template     - The view file to use for the body of the message
  #
  def email(to = "email@example.com", subject = "Subject:", template = "default")
    
    require 'pony'
    
    # We set the layout to false so that emails are not clogged with layout.erb
    set :layout => false
    
    Pony.mail :to                       => to,
              :bcc                      => "",
              :via                      => :smtp, 
              :via_options              => {
                  :address              => 'smtp.gmail.com',
                  :port                 => '587',
                  :enable_starttls_auto => true,
                  :user_name            => 'email@example.com',
                  :password             => 'password',
                  :authentication       => :plain, # :plain, :login, :cram_md5, no auth by default
                  :domain               => "www.yourdomain.com",
               },            
               :subject                 => subject,
               :html_body               => erb(:"mailers/#{template}", :layout => false)
          
  end
end