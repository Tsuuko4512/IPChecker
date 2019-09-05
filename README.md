# IPChecker

A website where you can see the IP address and host.

The interface is in Japanese.

No logging.

- http://sururun2.starfree.jp/
- http://sururun2.starfree.jp/ipchk.php

(hosted by starserver free)

## Feature
- View IP address and HOST.
- Determined if the IP address has changed.
- Returns ip on access with curl.

## Parameters

### mode=ip

Return only the IP address

``` ipchk.php?mode=ip or /?mode=ip ```

### mode=host

Return only the host.

``` ipchk.php?mode=host or /?mode=host ```

### mode=json

Return IP and host pairs with json.

``` ipchk.php?mode=json or /?mode=json ```
