var navbarAnimationTime = 300;

function openSidebar()
{
	$(".sidebar-menu-container").animate({
		left: "0px"
	}, navbarAnimationTime);

	$(".sidebar-toggle-container").animate({
		opacity: "0"
	}, navbarAnimationTime);
}

function closeSidebar()
{
	$(".sidebar-menu-container").animate({
		left: "-243px"
	}, navbarAnimationTime);

	$(".sidebar-toggle-container").animate({
		opacity: "1"
	}, navbarAnimationTime + navbarAnimationTime);
}

$(document).mouseup(function (e)
{
    var container = $(".navbar-container");

    if ( !container.is(e.target) && container.has(e.target).length === 0 )
    {
        closeSidebar();
    }
});