<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    
    <xsl:template match="/">
        <html>
            <body>
                <h2>List of One Student</h2>
                <xsl:for-each select="vtu/student[2]">
                    <div style="color:blue">
                        <div>
                            <xsl:value-of select="usn" />
                        </div>
                        <div>
                            <xsl:value-of select="name" />
                        </div>
                        <div>
                            <xsl:value-of select="branch" />
                        </div>
                        <div>
                            <xsl:value-of select="college" />
                        </div>
                        <div>
                            <xsl:value-of select="yearofjoin" />
                        </div>
                        <hr width="150" align="left" />
                        <div>
                            <xsl:value-of select="email" />
                        </div>
                    </div>
                </xsl:for-each>
            </body>
        </html>
    </xsl:template>
    
</xsl:stylesheet>
