require "sinatra"
require "./mailer"

# Your standard index route... do whatever you want here
get "/" do
  erb :index
end

get '/pagetwo' do
   erb :pagetwo
end

get '/contact' do
   erb :contact
end

#We set defaults, but for clarity we'll specify the arguments here
post "/contact" do
    email "jonathan@smashingboxes.com"
    
    # send thank you confirmation to user
    # email params.email, "Thank you for your message!", "thankyou"
    
    redirect '/contact'
end