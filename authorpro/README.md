# AuthorPro WordPress Theme

AuthorPro is a personal theme for authors and writers to showcase their books and connect with readers. It is designed to be elegant, content-focused, and conversion-oriented, helping authors sell books and build their mailing list.

## Features

*   **Homepage built with the WordPress Customizer**: Control all sections of your homepage directly from the live customizer.
*   **Custom Post Type for Books**: Easily manage your entire backlist. Includes fields for synopsis, cover image, publication date, publisher, and multiple purchase links.
*   **Custom Post Type for Events**: Announce book signings, talks, and other events. Includes fields for date, time, location, and a ticket/info link.
*   **Customizable Colors and Options**: Change the theme's accent color, upload a press kit, and edit footer text through the Customizer.
*   **Responsive, Mobile-First Design**: Looks great on all devices, from desktops to mobile phones.
*   **Clean, Literary-Inspired Design**: A strong focus on typography and readability to put your content first.

## Installation

1.  From your WordPress dashboard, navigate to `Appearance > Themes`.
2.  Click the `Add New` button at the top of the page.
3.  Click the `Upload Theme` button.
4.  Choose the `authorpro.zip` file and click `Install Now`.
5.  Once the theme is installed, click `Activate`.

## Initial Theme Setup

After activating the theme, follow these steps to get your site looking like the demo.

### 1. Create Core Pages

You need to create a few pages and assign the correct Page Template to them.

1.  **Create the Homepage**:
    *   Go to `Pages > Add New`.
    *   Title it `Home` (or whatever you prefer).
    *   In the "Page Attributes" box on the right, select the **Homepage** template.
    *   Click `Publish`.
2.  **Create the Books Page**:
    *   Go to `Pages > Add New`.
    *   Title it `Books`.
    *   In "Page Attributes", select the **Books Page** template.
    *   Click `Publish`.
3.  **Create the Events Page**:
    *   Go to `Pages > Add New`.
    *   Title it `Events`.
    *   In "Page Attributes", select the **Events Page** template.
    *   Click `Publish`.

### 2. Set Your Static Homepage

1.  Go to `Settings > Reading` in your WordPress dashboard.
2.  Under "Your homepage displays", select **A static page**.
3.  For the "Homepage" dropdown, select the **Home** page you created in the previous step.
4.  Save your changes.

### 3. Add Content

*   **Add Books**: Go to the new "Books" menu item in your dashboard to start adding your books. Don't forget to fill out the "Book Details" and set a "Book Cover" (Featured Image).
*   **Add Events**: Go to the "Events" menu item to add your events.

### 4. Configure the Homepage

*   Go to `Appearance > Customize`.
*   Open the **Homepage Sections** panel. Go through each section (Hero, Featured Book, etc.) to add your content and select which book to feature.
*   Open the **Theme Options** panel to set your accent color, upload a Press Kit PDF, and change the footer copyright text.

### 5. Set Up Your Navigation Menu

1.  Go to `Appearance > Menus`.
2.  Create a new menu.
3.  Add your newly created pages (Books, Events, etc.) to the menu.
4.  Under "Menu Settings" at the bottom, check the box for **Primary Menu**.
5.  Save the menu.

## How to Package for Installation

To create the installable `authorpro.zip` file from the source code:

1.  Navigate to the theme's directory (`/wp-content/themes/`).
2.  You will see the `authorpro` folder.
3.  Create a zip archive of the `authorpro` folder. **Important**: Do not zip the parent directory. The `style.css` file must be at the root level of the zip archive.
    *   On a Mac, right-click the `authorpro` folder and choose "Compress 'authorpro'".
    *   On Windows, right-click the `authorpro` folder, select "Send to > Compressed (zipped) folder".
4.  The resulting `authorpro.zip` file is what you will upload to WordPress.
