Hello,

It's garbage day tomorrow, <?php echo date('l\, F j', $subscriberData['Pickup']['start_date']) ?>.

Don't forget to take out your garbage and recycling!

http://www.londontrash.ca
(<?php echo $subscriberData['Zone']['formatted_title']; ?>)

--
To unsubscribe, please visit the following link:
http://londontrash.ca/u/<?php echo $subscriberData['Subscriber']['id']; ?>