 [![Get help on Codementor](https://cdn.codementor.io/badges/get_help_github.svg)](https://www.codementor.io/davidbrumbaugh?utm_source=github&utm_medium=button&utm_term=davidbrumbaugh&utm_campaign=github)

# Shortcode Cleaner
I wrote this plugin because when you take Visual Composer out of a site, it leaves behind *a lot* of "orphaned short codes".  I found a content filter on the WP Repository (https://wordpress.org/plugins/remove-orphan-shortcodes/) that will **hide** unused shortcodes, but I needed one that would **clean all** the shortcodes Visual Composer left behind so the content could be realistically maintained.

It won't just remove Visual Composer shortcodes, it will remove any unreigstered shortcodes.  This is may not always be what you want, so just be careful. This plugin *will*  alter your database so back it up before you use it.  

After you upload and activate the plugin, go to the "Clean Shortcode" option on the *Tools* menu.  Follow the prompts on the screen.

Once you've cleaned out the unused shortcodes, there's no good reason to leave the plugin installed. I recommend deactivating it and deleting it.

If you aren't comfortable backing up your database, uploading strange plugins, etc.  Contact me on CodeMentor, I'll probably be able to help you.
