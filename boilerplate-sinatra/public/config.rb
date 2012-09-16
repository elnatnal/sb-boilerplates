# Compass Configuration File

http_path        = "/"
css_dir          = "."
sass_dir         = "scss"
images_dir       = "img"
javascripts_dir  = "js"

output_style     = :compressed

line_comments    = false

on_stylesheet_saved do |filename|

  File.open(filename, 'w') do |new|
    new.write content
  end
  
end
