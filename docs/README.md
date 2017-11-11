# Global Description

You would have a login page, a personal dashboard (number of images, etc).

Homepage displays a list of users
User's page displays a list of albums and in second time list of all pictures.
If user doesn't have any album, just pictures, it would not display the album section.
Album's page displays list of pictures belonging to the album

# Uploader

A user, when uploading can either populate an existing album or create a new one or just upload without album.
There would be an uploader to upload multiple files at time with visual feedbacks (progression, error, success).
Or you can create an album and then populate it.

Images can be moved to an album later.

Backend would create different images sizes optimized for web.

# Album

In an album, you have the list of pictures (thumbnail), album's properties. Album would have tags generated from all picture's tags inside it.

Thumbnail of Album could be configured to be built based on random pictures inside the album or the last one or first one.

Album can be private, kinda public (not listed but if you have the url you can access it), public.

Album can be downloaded or not.

## smart albums

Albums that are generated automatically :
- Uploads last 15 days
- Favorites pictures (pictures could be faved)
- Last batch uploaded
- All public pictures

# Pictures

Pictures don't have a page strictly speaking, but there would be displayed full size in album when clicking on a thumbnail. You would a quite fullscreen with picture's properties info or just the image, two states would be toggled by clicking on the image.

Pictures can have tags (that would be for a later use, maybe a search engine).

# Preferences

Per user you can have preferences for sorting, information display (exif or not, default privacy album, maybe image compression, possibility to download), then you can override it in album's preferences.

One user must be elevated to admin, that would be the person that would install Poster obviously. The person could choose to have like just a personal gallery (1 user = admin) or a shared hosting gallery (N users + 1 admin).
If just one user, the homepage would be the user's album listing page.

There would be a dark and light theme.

# Menu

The menu would adapt depending on the context (homepage, albums, preferences, ...) to display relevant entries.

For instance, on user's homepage you would have an entry for creating an album and uploading, but on album's page just an entry for uploading to this album. Same for informations, an album's page that would be the album's ones, on picture page (fullscreen) that would be picture's ones.

# Database Schema

TO BE DONE

# Nice to have

- Sharing to social networks Facebook, Twitter,...
Could be nice to try to link albums between Poster and Facebook for instance, when you would upload to one album it would populate directly on Facebook's designated album. In the first time just in the feed.
- Adding overlay automatically to picture for copyright

TO BE COMPLETED FURTHERMORE
