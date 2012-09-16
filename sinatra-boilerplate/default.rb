<!-- Found in views/mailers/default.erb -->
<p>Hey,</p>
<p>We've received another contact form message:</p>

<p>Name: <%= params.name %></p>
<p>Email: <%= params.email %></p>

<p><%= params.message %></p>

<p>Kindly,</p>
<p>Your Neighborhood Email Robot</p>