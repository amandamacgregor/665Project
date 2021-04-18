# 665Project_PHP
This is a student project, with a team of two developers.

Description
• Purpose/Scope: Happy Earth Consignments is web based online clothing consignment
store designed for users to buy and sell used clothing items. The clothing resale/online thrift shopping industry is currently experiencing huge growth (see: https://www.thredup.com/resale/#resale-growth). Secondhand clothing is becoming more and more popular with shoppers who are hoping to reduce their “fashion footprint” by avoiding the resource waste associated with producing new clothing and/or throwing away clothing items that could still be useful. Our website provides a simple platform for individual users to list their unwanted clothing/accessory items for sale and for other individual users to browse these listed items and make purchases. Items will be listed for sale one at a time (no bulk listing) and buyers can add multiple items to. Our site will have an upbeat, earthy theme that emphasizes the eco-value and cost-value of buying/selling used clothes.
• Target Users: While the site is open to use for any user who successfully creates an account our target users will be people aged 20-39 with disposable income. Our target
  users have some or all of the following attributes:
Clothing Buyers:
o Enjoy shopping online
o Have bought clothing online
in past
o Enjoy shopping in brick-and-
mortar thrift/consignment
stores
o Change up their wardrobe
often and enjoy having something new to wear
Functionalities
Clothing Sellers:
• Are looking to tidy up their living space / get rid of clutter
• Have more clothing on their hands then they need
• Are looking to make a small amount of extra income
 • Users can upload a used clothing item for sale which will then be listed as available for purchase on the site
• Users who have sold an item can “cash out” by initiating a transfer of the value of their sales to their PayPal account
• Users can search available items
o Users can search by gender, item category, item size, item brand, date listed for
sale, and by price range
o Users can then view their search results
• Users can add items to their cart
• Users can view their cart and check out (purchase items in the cart)
• Users can return an item within 30 days of purchase

Business Rules
• Listings on the site must fall into one of the following categories:
o Shirts, Pants, Shorts, Skirts, Dresses, Shoes, Bags, Accessories
• Users must have created an account and be currently logged in to that account in order to list an item for sale
• Users must have created an account and be currently logged in to that account in order to purchase an item
• Users listing an item for sale will be required to describe the following descriptors: gender, category, size, brand, condition, and price
• Users listing an item for sale will be required to upload at least one photo of the item, users cannot upload more than one photo
• Users cannot list an item for sale without entering a method for payment
• Sellers
• Users cannot complete a purchase without entering a shipping address and payment
method
• Returns are only accepted within a 30-day window from the purchase date
Assumptions
• Users will be using the website to buy and sell clothing for their own personal use – the site will be designed for buying and selling individual items rather than bulk purchasing
• Users will be using the site from the following devices: Laptops/PCs, Tablets, Smartphones
• Some users will only be interested in using the site to sell items, some items will only be interested in using the site to browse/purchase items, and some users will be interested in using the site for both purposes
 Web Pages/Views
• Welcome/Landing Page: greets user, explains purpose of the site, encourages user to either browse items or list items for sale
• About/Contact Page: gives further details on the mission of the site
• Search Items Page: provides interface for user to search through items for sale
• Create Account/Log In Page: allows user to create an account or log into their existing account
• Manage Account Page: allows user to update profile information, view
Proposed Flows:
previous purchases, initiate a return, and view items they have for sale/have sold
• Sell Item Page: allows user to list an item for sale and provide required input about said item
• View Cart: allows user to view cart, edit or remove items in cart, and check out/purchase items in the cart
• Purchase Confirmation Page: confirms the user’s purchase
 • Welcome Page -> Create Account -> Sell Item Page
• Welcome Page -> Search Items -> Create Account -> View Cart -> Purchase Confirmation
• Welcome Page -> About Page -> Create Account -> Search Items
Validation
• In order to successfully create an account all, checks will be performed that the required fields must have been filled out by user:
o First Name o Email
o Last Name o Shipping Address
• Before a user can list their item on the site it will be checked that they have filled out
the following descriptors on their item listing:
o gender, category, size, brand, condition, and price
• Before users can access the following pages it will be checked that they are logged in to a valid account:
 o ManageAccountPage o Sell Item Page
 
Database Schema 
• User
o ViewCartandSubmit Purchase Page
o UserID,INT,PrimaryKeyforusertable
o Email,VARCHAR,useremail
o FirstName,VARCHAR,user’sfirstname
o LastName,VARCHAR,user’slastname
o Address, VARCHAR, users shipping address
o Created,DATETIME,timestampofaccountcreation
• Order
o OrderID,INT,PrimaryKeyforordertable
o ProductID, INT, Foreign Key, reference field of products within order 
o UserID, INT, Foreign Key, references user making the purchase
o Total, DECIMAL, a sum of the cost of all products in order
o Placed, DATETIME, the timestamp of the order
• Product
o ProductID, INT, Primary Key for product table
o CategoryID,INT,ForeignKey,referencecategorytable
o Name,VARCHAR,nameofproduct
o Description, VARCHAR, description of product
o Gender, CHAR, the gender best fit by the product
o Brand, VARCHAR, brand of the product
o Condition, CHAR, the condition of product ie, good, like new
o Size, CHAR, size of product
o Price,DECIMAL,priceforproduct
o Available,BOOL,flagtomarkifproductisavailableforpurchase
o Photo, VARBINARY, image of product
• Category
o CategoryID,INT,PrimaryKeyforcategorytable
o Name,VARCHAR,nameofcategory
o Description, VARCHAR, description of category and what products fall into it
• Listing
o ListingID,INT,PrimaryKeyforlistingtable
o ProductID, INT, Foreign Key referencing products within listing
o UserID, INT, Foreign key referencing the user who posted the listing o Created,DATETIME,timestampoflistingcreation

Model Sites
• https://www.thredup.c om/
• https://poshmark.com/
• https://www.therealreal.com/
