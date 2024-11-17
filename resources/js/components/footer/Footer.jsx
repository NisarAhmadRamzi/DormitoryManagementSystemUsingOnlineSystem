import React from "react";
import "./Footer.css";
import { Container, Row, Col } from "react-bootstrap";
import { FaFacebook, FaInstagram, FaLinkedin } from "react-icons/fa";
import { FaXTwitter } from "react-icons/fa6";
function Footer() {
    return (
        <div className="mt-5">
            <footer className="bg-dark text-white py-4">
                <Container>
                    <Row>
                        {/* Column 1: About */}
                        <Col xs={12} sm={6} md={3}>
                            <h5>About Us</h5>
                            <p>
                                Welcome to our dormitory, a comfortable and safe
                                space for students. We offer fully equipped
                                rooms, great amenities, and a vibrant student
                                life.
                            </p>
                        </Col>

                        {/* Column 2: Quick Links */}
                        <Col xs={12} sm={6} md={3}>
                            <h5>Quick Links</h5>
                            <ul className="list-unstyled">
                                <li>
                                    <a href="/about" className="text-white">
                                        About Us
                                    </a>
                                </li>
                                <li>
                                    <a href="/rooms" className="text-white">
                                        Rooms & Rates
                                    </a>
                                </li>
                                <li>
                                    <a href="/apply" className="text-white">
                                        Apply Now
                                    </a>
                                </li>
                                <li>
                                    <a href="/contact" className="text-white">
                                        Contact
                                    </a>
                                </li>
                            </ul>
                        </Col>

                        {/* Column 3: Contact Info */}
                        <Col xs={12} sm={6} md={3}>
                            <h5>Contact Us</h5>
                            <ul className="list-unstyled">
                                <li>
                                    <a
                                        href="tel:+1234567890"
                                        className="text-white"
                                    >
                                        +1 (234) 567-890
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="mailto:info@dormitory.com"
                                        className="text-white"
                                    >
                                        info@dormitory.com
                                    </a>
                                </li>
                                <li>123 Dormitory St, Campus City</li>
                            </ul>
                        </Col>

                        {/* Column 4: Social Media */}
                        <Col xs={12} sm={6} md={3}>
                            <h5>Follow Us</h5>
                            <div>
                                <a
                                    href="https://www.facebook.com"
                                    className="text-white mr-3"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <FaFacebook size={30} />
                                </a>
                                <a
                                    href="https://www.instagram.com"
                                    className="text-white mr-3"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <FaInstagram size={30} />
                                </a>
                                <a
                                    href="https://www.twitter.com"
                                    className="text-white mr-3"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <FaXTwitter size={30} />
                                </a>
                                <a
                                    href="https://www.linkedin.com"
                                    className="text-white"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <FaLinkedin size={30} />
                                </a>
                            </div>
                        </Col>
                    </Row>

                    {/* Footer Bottom */}
                    <Row className="mt-4">
                        <Col className="text-center">
                            <p className="mb-0">
                                © {new Date().getFullYear()} Dormitory. All
                                Rights Reserved.
                            </p>
                        </Col>
                    </Row>
                </Container>
            </footer>
        </div>
    );
}

export default Footer;
