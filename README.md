# About this repo 
This repo keeps all independent works (outside of the WordPress works) for our church's website - [Chinese For Christ Church of Hayward](https://www.cfcchayward.org/). 

Our church websites are built by WordPress, MySql database and hosted on AWS. WordPress provides ready-to-use features of login and authentication, members management, and customizable theme which allows us to build and maintain a website easily. (Note: WordPress code is not pushed here but backed up on AWS.)

However, WordPress is designed for information posting (e.g a blog website) and we still need to create and implement our web pages based on our needs. 

# Independent projects for church websites

Here are two new and independent projects I built for our website. 
1. `New Portal Entry page` - a new elegant entry page for both Chinese and English websites. This page is built and implemented by HTML, CSS, and JS.
2. `Sermon Management pages` - a new flow and pages for administrators to create, update, and delete sermon information and videos. This page is built and implemented by PHP, HTML, CSS, and JS. Data will be fetched and added to our current MySql database.

# Church websites projects architecture
<img width="700" alt="Projects flow" src="https://user-images.githubusercontent.com/99282632/153736722-cb3700c9-c6be-4f75-97e7-2c8e286c13b7.png"> 

# Folder location on the server

1. Entry page: public_html/<br/>
2. Sermon page: public_html/ch-sermon

# Project folders on this repo

1. **[EntryPage](https://github.com/DennisLyn/churchweb/tree/main/EntryPage):**  pure frontend works -  HTML, CSS, JS, and images files.
2. **[SermonListPage](https://github.com/DennisLyn/churchweb/tree/main/SermonListPage):** frontend + backend works -  PHP, CSS, and JS files.

# Wiki pages
* [New Portal Entry page](New-Portal-Entry-page)
* [Sermon Management Pages](Sermon-Management-pages)
