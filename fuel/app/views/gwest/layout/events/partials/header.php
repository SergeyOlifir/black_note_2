<nav>
    <h3 class="caption">Manage Events</h3>
    <ul class="clearfix">
        <li><a class="icon edit active" href="<?= \Fuel\Core\Uri::create("host/events/edit/{$event->id}"); ?>">Edit Event</a></li>
        <li><a class="icon pay" href="<?= \Fuel\Core\Uri::create("host/events/pay/{$event->id}"); ?>">Pay & Activate</a></li>
        <li><a class="icon invite" href="<?= \Fuel\Core\Uri::create("host/events/invite/{$event->id}"); ?>">Invite Guests</a></li>
        <li><a class="icon photo" href="<?= \Fuel\Core\Uri::create("host/events/view/{$event->id}"); ?>">View Photo</a></li>
    </ul>
</nav>