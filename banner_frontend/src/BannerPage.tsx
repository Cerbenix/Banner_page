import React, { useEffect, useState } from "react";
import { Container, Grid, Paper, Typography } from "@mui/material";
import Carousel from "react-material-ui-carousel";

interface Banner {
    id: number;
    url: string;
    target_type: string;
    position: number;
}

const BannerPage: React.FC = () => {
    const [banners, setBanners] = useState<Record<number, Banner[]>>({});
    const [randomSidebarBanner, setRandomSidebarBanner] =
        useState<Banner | null>(null);
    const [randomFooterBanners, setRandomFooterBanners] = useState<Banner[]>(
        []
    );
    const [clickedBanners, setClickedBanners] = useState<Set<number>>(
        new Set()
    );
    const sliderBanners = banners[1] || [];

    const fetchBanners = async () => {
        try {
            const response = await fetch("http://127.0.0.1:8000/api/banners");
            const data = await response.json();
            const bannersByPosition: Record<number, Banner[]> = {};
            data.forEach((banner: Banner) => {
                if (!bannersByPosition[banner.position]) {
                    bannersByPosition[banner.position] = [];
                }
                bannersByPosition[banner.position].push(banner);
            });
            return bannersByPosition;
        } catch (error) {
            console.error("Error fetching banners:", error);
            return {};
        }
    };

    const fetchData = async () => {
        const fetchedBanners = await fetchBanners();
        setBanners(fetchedBanners);
    };

    const incrementBannerView = async (bannerId: number) => {
        try {
            await fetch(`http://127.0.0.1:8000/api/banners/${bannerId}/view`, {
                method: "POST",
            });
        } catch (error) {
            console.error("Error updating view count:", error);
        }
    };

    const incrementBannerClick = async (bannerId: number) => {
        try {
            await fetch(`http://127.0.0.1:8000/api/banners/${bannerId}/click`, {
                method: "POST",
            });
        } catch (error) {
            console.error("Error updating click count:", error);
        }
    };

    useEffect(() => {
        fetchData();
    }, []);

    useEffect(() => {
        [...sliderBanners, randomSidebarBanner, ...randomFooterBanners].forEach(
            (banner) => {
                if (banner) {
                    incrementBannerView(banner.id);
                }
            }
        );
    }, []);

    useEffect(() => {
        if (banners[2]) {
            const randomIndex = Math.floor(Math.random() * banners[2].length);
            setRandomSidebarBanner(banners[2][randomIndex]);
        }

        if (banners[3] && banners[4] && banners[5]) {
            const randomBannerPosition3 =
                banners[3][Math.floor(Math.random() * banners[3].length)];
            const randomBannerPosition4 =
                banners[4][Math.floor(Math.random() * banners[4].length)];
            const randomBannerPosition5 =
                banners[5][Math.floor(Math.random() * banners[5].length)];

            setRandomFooterBanners([
                randomBannerPosition3,
                randomBannerPosition4,
                randomBannerPosition5,
            ]);
        }
    }, [banners]);

    const handleBannerClick = async (banner: Banner) => {
        if (banner.target_type === "new_window") {
            window.open("http://127.0.0.1:8000/image/" + banner.url, "_blank");
        } else {
            window.location.href = "http://127.0.0.1:8000/image/" + banner.url;
        }

        if (!clickedBanners.has(banner.id)) {
            setClickedBanners((prevClickedBanners) =>
                new Set(prevClickedBanners).add(banner.id)
            );
            incrementBannerClick(banner.id);
        }
    };

    return (
        <Container className="bg-slate-100 rounded-lg px-4 py-8 m-4">
            <div className="mb-4">
                <Carousel>
                    {sliderBanners.map((banner, index) => (
                        <div
                            key={index}
                            className="relative overflow-hidden"
                            style={{ paddingBottom: "20%" }}
                        >
                            <div className="absolute inset-0 flex justify-center">
                                <img
                                    src={
                                        "http://127.0.0.1:8000/image/" +
                                        banner.url
                                    }
                                    className="w-full h-full cursor-pointer object-cover"
                                    onClick={() => handleBannerClick(banner)}
                                />
                            </div>
                        </div>
                    ))}
                </Carousel>
            </div>

            <Grid container spacing={2} className="mt-8">
                <Grid item xs={9}>
                    <Paper className="p-4">
                        <Typography variant="h6" gutterBottom>
                            Welcome to our website!
                        </Typography>
                        <Typography paragraph>
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit.
                        </Typography>
                    </Paper>
                </Grid>
                <Grid item xs={3}>
                    <div className="relative" style={{ paddingBottom: "150%" }}>
                        <Paper className="absolute inset-0 flex items-center justify-center overflow-hidden">
                            {randomSidebarBanner && (
                                <img
                                    src={
                                        "http://127.0.0.1:8000/image/" +
                                        randomSidebarBanner.url
                                    }
                                    className="w-full h-full object-cover cursor-pointer"
                                    onClick={() =>
                                        handleBannerClick(randomSidebarBanner)
                                    }
                                />
                            )}
                        </Paper>
                    </div>
                </Grid>
            </Grid>

            <div className="mt-8">
                <Grid container spacing={2}>
                    {randomFooterBanners.map((banner, index) => (
                        <Grid item xs={4} key={index}>
                            <div
                                className="relative"
                                style={{ paddingBottom: "100%" }}
                            >
                                <Paper className="absolute inset-0 flex items-center justify-center overflow-hidden">
                                    <img
                                        src={
                                            "http://127.0.0.1:8000/image/" +
                                            banner.url
                                        }
                                        className="w-full h-full object-cover cursor-pointer"
                                        onClick={() =>
                                            handleBannerClick(banner)
                                        }
                                    />
                                </Paper>
                            </div>
                        </Grid>
                    ))}
                </Grid>
            </div>
        </Container>
    );
};

export default BannerPage;
