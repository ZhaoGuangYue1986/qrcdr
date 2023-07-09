<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0" xmlns:svg="http://www.w3.org/2000/svg">
<xsl:output method="xml" version="1.0" encoding="utf-8" />
    <xsl:template match="svg:svg 
        | svg:defs  | svg:defs/text() 
        | svg:mask | svg:mask/text() 
        | svg:stop | svg:stop/text() 
        | svg:image | svg:image/text() 
        | svg:g | svg:g/text()
        | svg:rect | svg:rect/text()
        | svg:circle | svg:circle/text()
        | svg:ellipse | svg:ellipse/text()
        | svg:line | svg:line/text()
        | svg:polyline | svg:polyline/text()
        | svg:polygon | svg:polygon/text()
        | svg:path | svg:path/text()
        | svg:linearGradient | svg:linearGradient/text()
        | svg:radialGradient | svg:radialGradient/text()
        | svg:text | svg:text/text()">
        <xsl:copy>
            <xsl:copy-of select="@*" />
            <xsl:apply-templates select="node()" />
        </xsl:copy>
    </xsl:template>
    <xsl:template match="@* | node()">
        <xsl:apply-templates select="@* | node()" />
    </xsl:template>
</xsl:stylesheet>