# BleuTrade-Bot
These PHP scripts provide the tools to customize and run your own algorithmic trading bot for use with the Bleutrade exchange. A big thank-you to beefviper, who wrote the bleutrade_function.php script to provide php wrappers for all of the Bleutrade API methods! Here is a link to the original repository: https://github.com/beefviper/BleuTrade-API-PHP

#Candle.php
The Candle.php class (located in classes directory) models a candle taken from a market. Candles contain data regarding a commodity's opening, high, low, and closing price over a certain interval of time. 
For more information on what candles are, and how to successfully analyze them, see this article from Investopedia: http://www.investopedia.com/terms/c/candlestick.asp

# Main.php
Main.php takes interval arguments from the command line and runs several simple analyses on market candles of these intervals. For example, to analyze 4 and 8 hour intervals enter:

php -f Main.php 4h 8h

# market_analysis.php
market_anlaysis.php provides the analytical tools that Main.php uses to examine an array of Candle objects. To customize this bot, write your own analysis functions here and include them in Main.php.

#create_file.php
This script creates or overwrites the text file "activity.txt" and writes the current date to the top of the file. To write to the activity.txt file, pipe all output from the Main.php file to activity.txt using the tee command. For example:

php -f Main.php 4h | tee activity.txt

#report.php
This script emails the contents of activity.txt to the specified email address. Use it to receive regular reports on what your bot has been doing.

#crontab
This is one example crontab that can be used with a unix-based machine to schedule Main.php to run on certain intervals. 
